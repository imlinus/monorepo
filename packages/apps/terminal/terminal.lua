shell = os.getenv('SHELL') or '/bin/sh'
inifile = require('libraries.LIP')
utils = require('libraries.utils')

lgi = require('lgi')
Gtk = lgi.require('Gtk', '3.0')
Gdk	= lgi.require('Gdk', '3.0')
Vte	= lgi.require('Vte', '2.91')
GLib = lgi.require('GLib', '2.0')

app = Gtk.Application()
term = Vte.Terminal()

utils:create_config('terminal', 'terminal.ini')

dir = ('%s/terminal'):format(GLib.get_user_config_dir())
conf = inifile:load(('%s/terminal.ini'):format(dir))

if conf.moonterm.quake_mode == true then
	Keybinder = lgi.require('Keybinder', '3.0')
end

require('src.terminal')
require('src.menu')
require('src.dialog')
require('src.keybinds')

app:run()
