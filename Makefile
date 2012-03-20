default: all

all: styles.css scripts.js

styles.css:
	cd ./css && make
	cd ../

scripts.js:
	cd ./js && make
	cd ../

release: all
	rm -rf ./css/*.less ./css/Makefile
	rm -rf ./js/jquery/*.js ./js/helper/*.js ./js/bootstrap/*.js ./js/main.js ./js/Makefile
	
