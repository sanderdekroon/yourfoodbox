<!DOCTYPE html>
<html>
<head>
    <title>Verboden toegang.</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:800' rel='stylesheet' type='text/css'>
    <style type="text/css">
        * {margin: 0; padding: 0;}
        body {background: black;}
        canvas {display: block;}
        h1 {position: absolute; top:40%; text-align:center; width: 100%; z-index: 99; color: white; font-family: 'Open Sans', sans-serif;}
    </style>
</head>
<body>
    <h1>Toegang verboden.</h1>
    <canvas id="c"></canvas>
    <script type="text/javascript">
        var c = document.getElementById("c");
        var ctx = c.getContext("2d");

        c.height = window.innerHeight;
        c.width = window.innerWidth;

        var characters = "ABCDEFGHIJKLMNOPQRSTUVW1234567890?!/`~+=-_[]{}()!@#$%^&*";
        characters = characters.split("");

        var font_size = 10;
        var columns = c.width/font_size;
        var drops = [];

        for(var x = 0; x < columns; x++)
            drops[x] = 1; 

        function draw()
        {
            ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
            ctx.fillRect(0, 0, c.width, c.height);
            
            ctx.fillStyle = "#0F0";
            ctx.font = font_size + "px arial";

            for(var i = 0; i < drops.length; i++)
            {
                var text = characters[Math.floor(Math.random()*characters.length)];
                ctx.fillText(text, i*font_size, drops[i]*font_size);
                if(drops[i]*font_size > c.height && Math.random() > 0.975)
                    drops[i] = 0;
                    drops[i]++;
            }
        }

        setInterval(draw, 33);
    </script>
</body>
</html>