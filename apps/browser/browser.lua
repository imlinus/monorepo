#!/usr/bin/env lua

lgi = require 'lgi'
Gtk = lgi.require('Gtk', '3.0')
Gdk = lgi.require('Gdk', '3.0')
GLib = lgi.require('GLib', '2.0')
Webkit = lgi.require('WebKit2','4.0')

if (mu_begin_window(ctx, "My Window", mu_rect(10, 10, 140, 86))) {
  mu_layout_row(ctx, 2, (int[]) { 60, -1 }, 0);

  mu_label(ctx, "First:");
  if (mu_button(ctx, "Button1")) {
    printf("Button1 pressed\n");
  }

  mu_label(ctx, "Second:");
  if (mu_button(ctx, "Button2")) {
    mu_open_popup(ctx, "My Popup");
  }

  if (mu_begin_popup(ctx, "My Popup")) {
    mu_label(ctx, "Hello world!");
    mu_end_popup(ctx);
  }

  mu_end_window(ctx);
}