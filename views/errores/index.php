<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404</title>
    <style>
        :root {
            font-family: Inter, system-ui, Avenir, Helvetica, Arial, sans-serif;
            line-height: 1.5;
            font-weight: 400;
        }
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        a {
            font-weight: 500;
            color: #646cff;
            text-decoration: inherit;
        }
        a:hover {
            color: #535bf2;
        }

        body {
            margin: 0;
            display: flex;
            place-items: center;
            min-width: 320px;
            min-height: 100vh;
            justify-content:center;
            flex-direction: column;
        }

        h1 {
            font-size: 3.2em;
            line-height: 1.1;
        }
        button {
            border-radius: 8px;
            border: 1px solid transparent;
            padding: 0.6em 1.2em;
            font-size: 1em;
            font-weight: 500;
            font-family: inherit;
            background-color: #7077ff;
            cursor: pointer;
            transition: border-color 0.25s;
            color:white;
        }
        button:hover {
            border-color: #646cff;
        }
        button:focus,
        button:focus-visible {
            outline: 8px auto -webkit-focus-ring-color;
        }
        .oops::before{
            content: "404";
            position: absolute;
            font-size: 3.2em;
            opacity: 0.2;
            transform: translate(22px,-92px);
        }
    </style>
</head>
<body>
    <h1 class="oops">Ooops!</h1>
    <h2>Relájate, tómatelo con calma.
    ¡Mantén fresca tu mente!</h2>
    <p>La página que estabas buscando no se pudo encontrar.
    Por favor regrese a la página de inicio.</p>
    <button>Ir a la página de inicio</button>
</body>
</html>