https://landley.net/writing/rootfs-intro.html

Summary: The new initramfs infrastructure in the 2.6 kernel is designed to replace not only initrd, but the kernel's built-in "root=" mechanism for finding the initial root filesystem.
The problem. (Why "root=" doesn't scale.)

When the Linux kernel boots the system, it must find and run the first user program, generally called "init". User programs live in filesystems, so the Linux kernel must find and mount the first (or "root") filesystem in order to boot successfully.

Ordinarily, available filesystems are listed in the file /etc/fstab so the mount program can find them. But /etc/fstab is itself a file, stored in a filesystem. Finding the very first filesystem is a chicken and egg problem, and to solve it the kernel developers created the kernel command line option "root=", to specify which device the root filesystem lives on.

Fifteen years ago, "root=" was easy to interpret. It was either a floppy drive or a partition on a hard drive. These days the root filesystem could be on dozens of different types of hardware (SCSI, SATA, flash MTD), or even spread across several of them in a RAID. Its location could move around from boot to boot, such as hot pluggable USB devices on a system with multiple USB ports -- when there are several USB devices, which one is correct? The root filesystem might be compressed (how?), encrypted (with what keys?), or loopback mounted (where?). It could even live out on a network server, requiring the kernel to acquire a DHCP address, perform a DNS lookup, and log in to a remote server (with username and password), all before the kernel can find and run the first userspace program.

These days, "root=" just isn't enough information. Even hard-wiring tons of special case behavior into the kernel doesn't help with device enumeration, encryption keys, or network logins that vary from system to system. Worse, programming the kernel to perform these kind of complicated multipart tasks is like writing web software in assembly language: it can be done, but it's considerably easier to simply use the proper tools for the job. The kernel is designed to follow orders, not give them.

With no end to this ever-increasing complexity in sight, the kernel developers decided to back up and find a better way to deal with the whole problem.
The solution

2.6 kernels bundle a small ram-based initial root filesystem into the kernel, and if this filesystem contains a program called "/init" the kernel runs that as its first program. At that point, finding some other filesystem containing some other program to run is no longer the kernel's problem, but is now the job of the new program.

The contents of initramfs don't have to be general purpose. If a given system's root filesystem lives on an encrypted network block device, and the network address, login, and decryption key are all to be found on a USB device named "larry" (which requires a password to access), that system's initramfs can have a special-purpose program that knows all about that, and makes it happen.

For systems that don't need a large root filesystem, there's no need to locate or switch to any other root filesystem.
How is this different from initrd?

The linux kernel already had a way to provide a ram-based root filesystem, the initrd mechanism (described in the January and February issues). For 2.4 and earlier kernels, initrd is still the only way to do this sort of thing. But the kernel developers chose to implement a new mechanism in 2.6 for several reasons.
ramdisk vs ramfs

A ramdisk (like initrd) is a ram based block device, which means it's a fixed size chunk of memory that can be formatted and mounted like a disk. This means the contents of the ramdisk have to be formatted and prepared with special tools (such as mke2fs and losetup), and like all block devices it requires a filesystem driver to interpret the data at runtime. This also imposes an artificial size limit that either wastes space (if the ramdisk isn't full, the extra memory it takes up still can't be used for anything else) or limits capacity (if the ramdisk fills up but other memory is still free, you can't expand it without reformatting it).

But ramdisks actually waste even more memory due to caching. Linux is designed to cache all files and directory entries read from or written to block devices, so Linux copies data to and from the ramdisk into the "page cache" (for file data), and the "dentry cache" (for directory entries). The downside of the ramdisk pretending to be a block device is it gets treated like a block device.

A few years ago, Linus Torvalds had a neat idea: what if Linux's cache could be mounted like a filesystem? Just keep the files in cache and never get rid of them until they're deleted or the system reboots? Linus wrote a tiny wrapper around the cache called "ramfs", and other kernel developers created an improved version called "tmpfs" (which can write the data to swap space, and limit the size of a given mount point so it fills up before consuming all available memory). Initramfs is an instance of tmpfs.

These ram based filesystems automatically grow or shrink to fit the size of the data they contain. Adding files to a ramfs (or extending existing files) automatically allocates more memory, and deleting or truncating files frees that memory. There's no duplication between block device and cache, because there's no block device. The copy in the cache is the only copy of the data. Best of all, this isn't new code but a new application for the existing Linux caching code, which means it adds almost no size, is very simple, and is based on extremely well tested infrastructure.

A system using initramfs as its root filesystem doesn't even need a single filesystem driver built into the kernel, because there are no block devices to interpret as filesystems. Just files living in memory.
Initrd vs initramfs

The change in underlying infrastructure was a reason for the kernel developers to create a new implementation, but while they were at it they cleaned up a lot of bad behavior and assumptions.

Initrd was designed as front-end to the old "root=" root device detection code, not a replacement for it. It ran a program called "/linuxrc" which was intended to perform setup functions (like logging on to the network, determining which of several devices contained the root partition, or associating a loopback device with a file), tell the kernel which block device contained the real root device (by writing the de_t number to /proc/sys/kernel/real-root-dev), and then return to the kernel so the kernel could mount the real root device and execute the real init program.

This assumed that the "real root device" was a block device rather than a network share, and also assumed that initrd wasn't itself going to be the real root filesystem. The kernel didn't even execute "/linuxrc" as the special process ID 1, because that process ID (and its special properties like being the only process that can not be killed with "kill -9") was reserved for init, which the kernel was waiting to run after it mounted the real root filesystem.

With initramfs, the kernel developers removed all these assumptions. Once the kernel launches "/init" out of initramfs, the kernel is done making decisions and can go back to following orders. With initramfs, the kernel doesn't care where the real root filesystem is (it's initramfs is until further notice), and the "/init" program from initramfs is run as a real init, with PID 1. (If initramfs' init needs to hand that special Process ID off to another program, it can use the exec() syscall just like everybody else.)
Summary

The traditional root= kernel command-line option is still supported and usable, but new developments in the types of initial RAM disks supported by the kernel provide many optimizations and much-needed flexibility for the future of the Linux kernel. The next article in this series, available in next month's issue of TimeSource, explains how you can start making the transition to the new initramfs initial RAM disk mechanism.

