
zip:
	rm -f plg_siginsertbutton.zip
	cd src/; zip -r ../plg_siginsertbutton.zip *

phptest:
	if find . -name "*.php" -exec php -l {} 2>&1 \; | grep "syntax error, unexpected"; then exit 1; fi

.PHONY: zip
