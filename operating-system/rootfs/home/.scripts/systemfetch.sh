#!/bin/sh

export HOST="$(hostname)"
export OS='Lily OS'
export VERSION='v0.1 (Pre-Alpha)'

export KERNEL="$(uname -sr)"
export UPTIME="$(uptime -p | sed 's/up //')"
#packages="$(lpm -Q | wc -l)"
export PACKAGES="307" #"$(dpkg -l | grep -c ^i)"
export SHELL="Shell" #"$(basename "$SHELL")"

# Colors
if [ -x "$(command -v tput)" ]; then
	bold="$(tput bold)"
	black="$(tput setaf 0)"
	green="$(tput setaf 2)"
	magenta="$(tput setaf 5)"
	white="$(tput setaf 7)"
	reset="$(tput sgr0)"
fi

label="${reset}${bold}${white}" 

lily1="${magenta}${bold}     _      ${reset}"
lily2="${magenta}${bold}   _(_)_    ${reset}"
lily3="${magenta}${bold}  (_)${white}•${magenta}${bold}(_)   ${reset}"
lily4="${green}${bold}   /${reset}${magenta}${bold}(_)     ${reset}"
lily5="${green}${bold}   \        ${reset}"
lily6="${green}${bold}    \       ${reset}"

cat <<EOF
${lily1}
${lily2}{label}Host:${reset}     ${HOST}${reset}
${lily3}${label}Distro:${reset}   ${OS} ${VERSION}${reset}
${lily4}${label}Kernel:${reset}   ${KERNEL}${reset}
${lily5}${label}Uptime:${reset}   ${UPTIME}${reset}
${lily6}${label}Packages:${reset} ${PACKAGES}${reset}

EOF
}
