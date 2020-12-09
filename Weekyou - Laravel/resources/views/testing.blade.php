<!DOCTYPE html>
<html>
  <head>
    <script src="https://unpkg.com/konva@5.0.2/konva.min.js"></script>
    <meta charset="utf-8" />
    <title>Konva Free Drawing Demo</title>
    <style>
      body {
          background-color: rgb(239, 241, 244);
        margin: 0;
        padding: 0;
        overflow: hidden;

      }

      #imgInp{
          margin-left: 1vh;
      }
      #container {
        margin-left: 1vw;
          border: 1px solid black;
        display: flex;
        float: left;
      }

      #menu {
            margin-left: 1vw;
            background-color: white;
            border-radius: 3%;
            overflow: hidden;
            justify-content: left;
            padding: 0.5vh;
            justify-content: center;
            float: left;
      }

      #tool{
          color: black;
          padding: 0.5vh;

      }

      #header{
          padding: 1vh;
          height: 3vh;
          margin-bottom: 1vh;
      }

      .brush{
          height: 8vh;
          padding: 1vh;
          padding-left: 4vw;
      }

      .float-left{
          float: left;
      }
      .btn {
        background-color: rgb(255, 255, 255);
border-color: rgb(98, 224, 195);
border-style: solid;
border-width: 2px;
border-radius: 30px;
height: 25px;
font-size: 15px;
font-weight: 500;
color: rgb(58, 193, 162);
margin-bottom: 30px !important;
margin-right: 1vw;
      }
    </style>
    <style>
        .input-file-container {
            margin-top: 2vh;
  position: relative;
  width: 80%;
  margin-left: 10%;
}
.js .input-file-trigger {
  display: block;
  padding: 14px 45px;
  background: #39D2B4;
  color: #fff;
  font-size: 1em;
  transition: all .4s;
  cursor: pointer;
}
.js .input-file {
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  opacity: 0;
  padding: 14px 0;
  cursor: pointer;
}
.js .input-file:hover + .input-file-trigger,
.js .input-file:focus + .input-file-trigger,
.js .input-file-trigger:hover,
.js .input-file-trigger:focus {
  background: #34495E;
  color: #39D2B4;
}

.file-return {
  margin: 0;
}
.file-return:not(:empty) {
  margin: 1em 0;
}
.js .file-return {
  font-style: italic;
  font-size: .9em;
  font-weight: bold;
}
.js .file-return:not(:empty):before {
  content: "Selected file: ";
  font-style: normal;
  font-weight: normal;
}

.input-color-container {
  position: relative;
  overflow: hidden;
  width: 40px;
  height: 40px;
  border: solid 2px #ddd;
  border-radius: 40px;
}

.input-color {
  position: absolute;
  right: -8px;
  top: -8px;
  width: 56px;
  height: 56px;
  border: none;
}

.input-color-label {
  cursor: pointer;
  text-decoration: underline;
  color: #3498db;
}
    </style>
    <script src="https://kit.fontawesome.com/1c8538c20e.js" crossorigin="anonymous"></script>
  </head>

  <body>
    <header id="header">
        <button class="btn">Home</button>
        <button class="btn">Projects</button>
        <button class="btn">Resources</button>
    </header>
    <div id="container"></div>


    <div id="menu">

        <div class="brush">
          <label for="tool" class="float-left" style="padding-top:1.5vh;margin-right: 1.5vw">Tool</label>
    <select id="tool" class="float-left" style="margin-right: 1vw; margin-top:0.7vh">
    <option value="brush">Brush</option>
      <option value="eraser">Eraser</option>
    </select>
    <div class="input-color-container" class="float-left">
        <input id="input-color" value="orange" class="input-color" type="color" onchange="changeColorLine()">
      </div>
      <button onclick="markerTrue()"><ion-icon name="flag-outline"></ion-icon></button>
        </div>




        <form runat="server" style="width:100%; display:block">

            <div class="input-file-container">
                <input class="input-file" id="imgInp" type="file">
                <label tabindex="0" for="imgInp" class="input-file-trigger">Select a file...</label>
              </div>

          </form>
    </div>

    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");

button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        fileInput.focus();
    }
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});
fileInput.addEventListener( "change", function( event ) {
    the_return.innerHTML = this.value;
});
    </script>
    <script>
        function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {

       // main API:
       var imageObj = new Image();
      imageObj.onload = function() {
        var yoda = new Konva.Image({

          image: imageObj,
            width: (width * 75) / 100,
            height: (height * 90) / 100
        });

        // add the shape to the layer
        layer.add(yoda);
        layer.batchDraw();
      };
      imageObj.src = e.target.result;
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
    </script>
    <script>
        var colorPicker = document.getElementById('input-color').value = '#000000';

      var colorLine = '#000000';
      var width = window.innerWidth;
      var height = window.innerHeight;

        let contain = document.getElementById('container');
        contain.style.height = '90vh';
        contain.style.width = '75vw';

        let menu = document.getElementById('menu');
        menu.style.height = '90vh';
        menu.style.width = '20vw';


      // first we need Konva core things: stage and layer
      var stage = new Konva.Stage({
        container: 'container',
        image: '',
        width: (width * 75) / 100,
        height: (height * 90) / 100,

      });

      var layer = new Konva.Layer();
      stage.add(layer);

      var isPaint = false;
      var mode = 'brush';
      var lastLine;

      stage.on('mousedown touchstart', function(e) {
        isPaint = true;
        var pos = stage.getPointerPosition();
        lastLine = new Konva.Line({
          stroke: colorLine,
          strokeWidth: 5,
          globalCompositeOperation:
            mode === 'brush' ? 'source-over' : 'destination-out',
          points: [pos.x, pos.y]
        });
        layer.add(lastLine);
      });

      stage.on('mouseup touchend', function() {
        isPaint = false;
      });

      // and core function - drawing
      stage.on('mousemove touchmove', function() {
        if (!isPaint) {
          return;
        }

        const pos = stage.getPointerPosition();
        var newPoints = lastLine.points().concat([pos.x, pos.y]);
        lastLine.points(newPoints);
        layer.batchDraw();
      });

      var select = document.getElementById('tool');
      select.addEventListener('change', function() {
        mode = select.value;
      });

      function changeColorLine() {
        var color = document.getElementById('input-color').value;
        colorLine = color;
      }

      // var simpleText = new Konva.Text({
      //   x: stage.width() / 2,
      //   y: 15,
      //   text: '1',
      //   fontSize: 30,
      //   fontFamily: 'Calibri',
      //   fill: 'green',
      //   draggable: true
      // });

      // layer.add(simpleText);
      // stage.add(layer);
        var cantMarkers = 0;
        var marker = false;
        var buttonClicked = false;
        document.addEventListener('click', (e) => {
          // console.log(marker);
          if(buttonClicked){
            return buttonClicked = false;
          }
          if(marker == true){
            // console.log('paso');

            cantMarkers++;
          var simpleText = new Konva.Text({
          x: e.clientX -30,
          y: e.clientY -60,
          text: cantMarkers,
          fontSize: 50,
          fontFamily: 'Calibri',
          fill: colorLine,
          draggable: true
        });

      layer.add(simpleText);
      stage.add(layer);
          }
          // console.log(marker);
        return marker = false;


        });

        function markerTrue(){
          marker = true;
          buttonClicked = true;
          // console.log(marker);
          return marker;
        }

    </script>

  </body>
</html>
