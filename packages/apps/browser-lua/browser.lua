#!/usr/bin/env lua

lgi = require 'lgi'
Gtk = lgi.require('Gtk', '3.0')
Gdk = lgi.require('Gdk', '3.0')
GLib = lgi.require('GLib', '2.0')
Webkit = lgi.require('WebKit2','4.0')

app = Gtk.Application()
webview = Webkit.WebView()

content = Gtk.Box {
  orientation = 'VERTICAL',
  Gtk.Box {
    expand = false,
    orientation = 'HORIZONTAL',
    Gtk.Button {
      relief = Gtk.ReliefStyle.NONE,
      Gtk.Image { icon_name = 'back-symbolic' },
      on_clicked = function()
        webview:go_back()
      end
    },
    Gtk.Button {
        relief = Gtk.ReliefStyle.NONE,
        Gtk.Image { icon_name = 'next-symbolic' },
        on_clicked = function()
          webview:go_forward()
        end
    },
    Gtk.Button {
        relief = Gtk.ReliefStyle.NONE,
        Gtk.Image { icon_name = 'reload-symbolic' },
        on_clicked = function()
          webview:reload()
        end
    },
    Gtk.Separator(),
    Gtk.Entry { id = 'entry_url', expand = true },
    Gtk.Separator(),
    Gtk.Button {
      relief = Gtk.ReliefStyle.NONE,
      Gtk.Image { icon_name = 'gtk-home-symbolic' },
      on_clicked = function()
        webview:load_uri('http://duckduckgo.com')
        content.child.entry_url.text = 'duckduckgo.com'
      end
    }
  },
  Gtk.Box {
    orientation = 'VERTICAL',
    Gtk.ScrolledWindow { id = 'scroll', expand = true }
 },
}

main_window	= Gtk.Window {
  width_request	= 800,
  height_request	= 600,
  content
}

function browser_init()
  webview:load_uri('http://duckduckgo.com')

  main_window.child.entry_url.text = 'duckduckgo.com'
  main_window.title = webview:get_title()
end

GLib.timeout_add_seconds(GLib.PRIORITY_DEFAULT, 1, function()
  main_window.title = webview:get_title()

  return true
end)

function main_window:on_destroy()
  Gtk.main_quit()
end

function main_window.child.entry_url:on_key_release_event(event)
  if (event.keyval  == Gdk.KEY_Return) then
    webview:load_uri('http://' .. main_window.child.entry_url.text)
  end
end

function app:on_activate()
  main_window.child.scroll:add(webview)
  main_window.child.entry_url.set_icon_from_icon_name(
    main_window.child.entry_url,
    1,
    'find-symbolic'
  )

  main_window:show_all()
  browser_init()

  self:add_window(main_window)
end

app:run()
