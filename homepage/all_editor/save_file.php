<html>
    <head>
        <style>
        <?php
            echo ltrim(file_get_contents("css.css"));
        ?>
        </style>
    </head>
    <body>
    <?php
            echo ltrim(file_get_contents("html.html"));
    ?>
    <script>
        <?php
            echo ltrim(file_get_contents("js.js"));
        ?>  
    </script>
    </body>
</html>