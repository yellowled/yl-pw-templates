# My boilerplate for ProcessWire

The default templates provided by [ProcessWire](http://processwire.com) hold a lot of stuff I usually drop when starting a new project. This is a stripped-down version of said templates, including a few templates I usually need in projects.

Note that this does not contain the default's CSS and JS files. I usually replace those with files provided by [my HTML project boilerplate](https://github.com/yellowled/yl-bp). Also note that since I'm German (and most of the sites I build are, too), I translated some hardcoded text into German.

## Setting up

To use these templates files, you need two lines in your `/site/config.inc.php`:

```
$config->prependTemplateFile = '_init.php';
$config->appendTemplateFile = '_main.php';
```
