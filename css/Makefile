LESSC = lessc

default: all

all: clean css

css: editor-style.css

wp-bootstrap.css:
	$(LESSC) < wp-bootstrap.less > wp-bootstrap.css

editor-style.css: wp-bootstrap.css
	$(LESSC) < editor-style.less > editor-style.css

clean:
	rm -f *.css
