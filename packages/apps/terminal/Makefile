LUASTATIC ?= luastatic
LUA ?= lua5.1
LUA_INCLUDE ?= /usr/include/$(LUA)

PREFIX ?= /usr/local
BINDIR ?= $(PREFIX)/bin
DESKTOP_DIR ?= $(PREFIX)/share/applications

SRC = moonterm.lua src/moonterm-dialog.lua src/moonterm-app.lua  \
	src/moonterm-menu.lua src/moonterm-keybinds.lua libraries/LIP.lua \
	libraries/utils.lua

moonterm: 
	$(LUASTATIC) $(SRC) -l$(LUA) -I$(LUA_INCLUDE)
	@strip moonterm

install:
	install -Dm775 terminal $(DESTDIR)$(BINDIR)/terminal
	install -Dm775 data/terminal.desktop $(DESTDIR)$(DESKTOP_DIR)/terminal.desktop

uninstall:
	rm -rf $(DESTDIR)$(BINDIR)/terminal
	rm -rf $(DESTDIR)$(DESKTOP_DIR)/terminal.desktop

clean:
	rm -rf terminal.luastatic.c
	rm -rf terminal

.PHONY: terminal
