YUIC=java -jar ../resources/yuicompressor.jar --type js

all: clean js

js: wp-bootstrap.js

wp-bootstrap.js: main.js
	cat jquery.min.js bootstrap.min.js helper.min.js main.min.js > wp-bootstrap.min.js
	rm jquery.min.js bootstrap.min.js helper.min.js main.min.js

main.js: bootstrap.js helper.js
	$(YUIC) main.js > main.min.js

bootstrap.js: jquery.js
	cat bootstrap/bootstrap-alert.js \
            bootstrap/bootstrap-button.js \
            bootstrap/bootstrap-carousel.js \
            bootstrap/bootstrap-collapse.js \
            bootstrap/bootstrap-dropdown.js \
            bootstrap/bootstrap-modal.js \
            bootstrap/bootstrap-tooltip.js \
            bootstrap/bootstrap-popover.js \
            bootstrap/bootstrap-scrollspy.js \
            bootstrap/bootstrap-tab.js \
            bootstrap/bootstrap-transition.js \
            bootstrap/bootstrap-typeahead.js | $(YUIC) > bootstrap.min.js

helper.js: jquery.js
	cat helper/facebox.js helper/prettify.js | $(YUIC) > helper.min.js

jquery.js:
	cp jquery/jquery.js jquery.min.js

clean: 
	rm -f *.min.js
