<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Calculator</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="calculator">
    <input type="text" class="calculator-screen" value="" disabled/>

    <div class="calculator-keys">
        <button type="button" value="<">&DoubleLeftArrow;</button>
        <button type="button" value=">">&Rightarrow;</button>
        <button type="button" value="SC">&#x232B;</button>
        <button type="button" value="AC">AC</button>

        <button type="button" value="+">+</button>
        <button type="button" value="-">-</button>
        <button type="button" value="*">*</button>
        <button type="button" value="/">/</button>

        <button type="button" class="number" value="7">7</button>
        <button type="button" class="number" value="8">8</button>
        <button type="button" class="number" value="9">9</button>
        <button type="button" value="(">(</button>

        <button type="button" class="number" value="4">4</button>
        <button type="button" class="number" value="5">5</button>
        <button type="button" class="number" value="6">6</button>
        <button type="button" value=")">)</button>

        <button type="button" class="number" value="1">1</button>
        <button type="button" class="number" value="2">2</button>
        <button type="button" class="number" value="3">3</button>
        <button type="button" value="^">^</button>

        <button type="button" class="number" value="0" style="grid-column: span 3">0</button>
        <button type="button" class="equal-sign" id="equal-sign" value="=">=</button>
    </div>
</div>
</body>
</html>
