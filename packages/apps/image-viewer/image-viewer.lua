lgi = require('lgi')
Gtk = lgi.require('Gtk', '3.0')
Gdk = lgi.require('Gdk', '3.0')
GLib = lgi.require('GLib', '2.0')
Gio = lgi.require('Gio', '2.0')
GdkPixbuf	= lgi.require('GdkPixbuf', '2.0')

app = Gtk.Application.new('com.github.sodomon2.moonview', Gio.ApplicationFlags.HANDLES_OPEN)

image_chooser = Gtk.FileChooserDialog({
	title = 'Open Image File',
	action = Gtk.FileChooserAction.OPEN
})

image_chooser:add_button('Open', Gtk.ResponseType.OK)
image_chooser:add_button('Cancel', Gtk.ResponseType.CANCEL)

main_window = Gtk.Window ({
	default_width	= screen:get_width(),
	default_height = screen:get_height(),
	Gtk.ScrolledWindow {
		Gtk.Image {
			id = 'image_view',
			visible	= true
		}
	}
})

local headerbar	= Gtk.HeaderBar {
	title		= 'Image Viewer',
	show_close_button = true
}

main_window:set_titlebar(headerbar)

function filename(image_file)
	local t = {}

	for str in string.gmatch(image_file, '([^/]+)') do
		table.insert(t, str)
	end

	return t[#t]
end

function get_image_from_chooser()
	local file = image_chooser:get_filename()

	image = GdkPixbuf.Pixbuf.new_from_file_at_size(file, 900, 750)
	headerbar.title = filename(file)
	main_window.child.image_view:set_from_pixbuf(image)
	image_chooser:hide()
end

function app:on_open(files)
	local file = files[1] and files[1]:get_parse_name()

	if (file) then
		image = GdkPixbuf.Pixbuf.new_from_file(file)
	end

	main_window.child.image_view:set_from_pixbuf(image)
	main_window:show_all()
end

function main_window:on_destroy()
	Gtk.main_quit()
	app:quit()
end

function app:on_activate()
	chooser = image_chooser:run()

	if chooser == Gtk.ResponseType.OK then
		get_image_from_chooser()
		main_window:show_all()
	elseif chooser == Gtk.ResponseType.CANCEL then
		image_chooser:hide()
		os.exit(1)
	end

	main_window:set_icon_name('image-viewer')
end

function main_window:on_button_press_event(event)	
	if (event.type == 'BUTTON_PRESS' and event.button == 3) then
		menu = Gtk.Menu {
			Gtk.ImageMenuItem {
				label = 'Open File',
				image = Gtk.Image {
					stock = 'gtk-open'
				},
				on_activate = function()
					image_chooser:run()
					get_image_from_chooser()
				end
			},

			Gtk.SeparatorMenuItem {},

			Gtk.ImageMenuItem {
				label = 'Quit',
				image = Gtk.Image {
					stock = 'gtk-quit'
				},
				on_activate = function()
					Gtk.main_quit()
					app:quit()
				end
			}
		}

		menu:attach_to_widget(main_window, null)
		menu:show_all()
		menu:popup(nil, nil, nil, event.button, event.time)
	end
end

app:run({ arg[1], ... })
Gtk.main()
