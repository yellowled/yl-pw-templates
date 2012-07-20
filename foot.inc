<?php // Global site footer include file ?>

	<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo $config->urls->templates?>js/libs/jquery-1.7.2.min.js"><\/script>')</script>
    <!-- scripts concatenated and minified via build script -->
    <script src="<?php echo $config->urls->templates?>js/plugins.js"></script>
    <script src="<?php echo $config->urls->templates?>js/script.js"></script>
    <!-- end scripts -->
</body>
</html>
