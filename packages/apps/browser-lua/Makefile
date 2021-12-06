LUASTATIC = luastatic
LUA = lua5.1
LUA_INCLUDE = /usr/include/$(LUA)

PREFIX = /usr/local
BINDIR = $(PREFIX)/bin
DESKTOP_DIR = $(PREFIX)/share/applications

SRC = browser.lua

browser:
	$(LUASTATIC) $(SRC) -l$(LUA) -I$(LUA_INCLUDE)
	strip browser

install:
	install -Dm775 browser $(DESTDIR)$(BINDIR)/browser
	install -Dm775 browser.desktop $(DESTDIR)$(DESKTOP_DIR)/browser.desktop

uninstall:
	rm -rf $(DESTDIR)$(BINDIR)/browser
	rm -rf $(DESTDIR)$(DESKTOP_DIR)/browser.desktop

clean:
	rm -rf browser.luastatic.c
	rm -rf browser

.PHONY: browser
