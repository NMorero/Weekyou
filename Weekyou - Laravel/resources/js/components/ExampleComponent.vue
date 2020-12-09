<template>
    <div class="main">


        <canvas @mousedown="startPainting" @mouseup="finishedPainting" @mousemove="draw"  id="canvas"  @click="addNumber">

        </canvas>

        <div id="menu">
            <h3>Tools</h3>
            <input type="file" name="" id="imgInput" @change="attachImg($event)" hidden>
            <input type="file" name="" id="backInput" @change="onFileChange" hidden>
            <input type="color" v-model="color" id="colorInput" hidden>


            <button class="btnMenu" id="btn4" @click="flagPalette = false;oBackInp(); setFocus(4)"><i class="fas fa-folder-plus"></i></button>
             <button class="btnMenu" id="btn1" @click="flagPalette = false;flag = false; brushF = true; setFocus(1)"><i class="fas fa-paint-brush"></i></button>
            <button class="btnMenu" id="btn2" @click="flagPalette = !flagPalette; setFocus(2)"><i class="fas fa-palette"></i>
            </button>
            <div class="dropdownContent" v-if="flagPalette">
                     <button id="color1" @click="setFocusDrop('color1'); color = 'black'"><i class="fas fa-circle"></i></button>
                     <button id="color2" @click="setFocusDrop('color2'); color = 'red'"><i class="fas fa-circle"></i></button>
                     <button id="color3" @click="setFocusDrop('color3'); color = 'blue'"><i class="fas fa-circle"></i></button>
                     <button id="color4" @click="setFocusDrop('color4'); color = 'green'"><i class="fas fa-circle"></i></button>
            </div>



            <button class="btnMenu" id="btn3" @click="flagPalette = false;flag = true; brushF = false; setFocus(3)"><i class="far fa-flag"></i></button>

            <button class="btnMenu" id="btn5" @click="flagPalette = false;cUndo(); setFocus(5)"><i class="fas fa-undo-alt"></i></button>
            <button class="btnMenu" id="btn6" @click="flagPalette = false;cRedo(); setFocus(6)"><i class="fas fa-redo-alt"></i></button>

            <br><br>

            <h3>Comments</h3>


                <div id="commentBox">


                    <div v-for="comm in comments" :key="comm.id" :id="'comentBox' + comm.id" class="">

                        <div class="input">
                            <span>{{comm.number}}</span>  <textarea :id="'textArea'+ comm.id" type="text"  v-model="comm.value" cols="30" :rows="comm.textRow" @input="resize($event)"></textarea> <span @click="oImg(comm.id)"><i class="fas fa-folder-plus"></i></span>
                        <br>
                        </div>
                       <div class="divImgAttach">
                            <img v-if="comm.image" :src="comm.image" v-bind:class="{marginLeft: comm.width}" alt="" :id="'attachImg'+comm.number" >
                       </div>
                    </div>


                </div>

                    <label for="clientSelect">Client: </label>
                <select name="client" id="clientSelect" v-model="client" @change="getProjects">
                    <option v-for="cl in clients" :value="cl.id" :key="cl.id">{{cl.client_name}}</option>
                </select>
                <label for="projectSelect">Project: </label>
                <select name="project" id="projectSelect" v-model="project">
                    <option v-for="pr in projects" :value="pr.id" :key="pr.id">{{pr.project_name}}</option>
                </select>
                <button id="btnAddCom" @click="saveFeedback">Save</button>

        </div>



    </div>

</template>
<script>


    export default {

        data() {
            return {
                clients: null,
                projects:null,
                showModal: false,
                message: 'Hello Vue!',
                vueCanvas:null,
                painting:false,
                canvas:null,
                ctx:null,
                comments: [],
                image: null,
                cantMark: 0,
                flag: false,
                color: 'black',
                cStep: 0,
                cPushArray: new Array,
                newImg: false,
                brushF: false,
                flagPalette:false,
                client: null,
                project: null,

            };
        },

        methods: {

            resize(e){
                e.target.style.height = 'auto';
                e.target.style.height = e.target.scrollHeight + 'px'
            },
            setFocusDrop(id){
                document.getElementById('color1').style.backgroundColor = '#39D2B4';
                document.getElementById('color2').style.backgroundColor = '#39D2B4';
                document.getElementById('color3').style.backgroundColor = '#39D2B4';

                document.getElementById(id).style.backgroundColor = '#34349e';
            },
            onFileChange(e) {
                const file = e.target.files[0];
                this.image = URL.createObjectURL(file);
                var ctx = canvas.getContext("2d");


                var img = new Image();
                img.src = this.image;
                 var w = window.innerWidth;
            var h = window.innerHeight;


                img.onload = function() {
                     var hImg = this.height;
                var wImg = this.width;

                var rAsp = wImg / hImg;
                console.log(rAsp);


                    if(w <= 1400 && w > 1280){
                        if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 1000, 562);
                        }else{
                            var newW = (562 * wImg) / hImg;
                            var newX = 1000 - newW;
                            ctx.drawImage(img,  newX / 2, 0, newW, 562);
                        }


                    }else if(w <= 1280 && w > 1000){

                          if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 1000, 562);
                        }else{
                            var newW = (562 * wImg) / hImg;
                             var newX = 1000 - newW;

                          ctx.drawImage(img,  newX / 2, 0, newW, 450);
                        }
                     }else if(w <= 1000){

                          if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 700, 394);
                        }else{
                            var newW = (394 * wImg) / hImg;
                             var newX = 700 - newW;
                            ctx.drawImage(img,  newX / 2, 0, newW, 394);
                        }
                    }else{
                        if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 1280, 720);
                        }else{
                            var newW = (720 * wImg) / hImg;
                            var newX = 1280 - newW;
                            ctx.drawImage(img, newX / 2, 0, newW, 720);
                        }

                    }

                }


                },
            startPainting(e) {
                if(!this.brushF){return}
            this.painting = true;
            console.log(this.painting)
            this.draw(e)
            },
            finishedPainting() {

                this.cStep++;
                this.cPushArray.push(document.getElementById('canvas').toDataURL());
                console.log(this.cPushArray);

            this.painting = false;
            console.log(this.painting);
            this.ctx.beginPath()
            },
            draw(e) {
            if(!this.painting) return

            this.ctx.lineWidth = 10;
            this.ctx.lineCap ="round";
            this.ctx.strokeStyle = this.color;

            this.ctx.lineTo(e.clientX - 10,e.clientY - 50)
            this.ctx.stroke()

            this.ctx.beginPath()
            this.ctx.moveTo(e.clientX - 10,e.clientY - 50)


            },

            attachImg(e){
                var image = document.getElementById('imgInput').files[0];
                var url = URL.createObjectURL(image);
                var id = document.getElementById('imgInput').alt;
                var menu = document.getElementById('menu');
                this.comments[id].image = url;




            },

            addNumber(e){
                if(this.flag){
                    this.cantMark++;

                    this.ctx.fillStyle = this.color;
                    this.ctx.font = "bold 40px Arial";
                    this.ctx.fillText(this.cantMark, e.clientX - 20,e.clientY-45);
                    //this.flag =false;

                    this.comments.push({id:this.comments.length, value:'', number: this.cantMark, image:'', width:'0px'});

                }

            },
            cUndo() {
                if(this.cStep < 0){this.cStep = 0}
                var ctx = canvas.getContext("2d");

                this.cStep--;
                var ant = this.cPushArray[this.cStep];
                console.log('ant: ' + ant);
                this.image = ant;
                this.ctx.clearRect(0,0, this.canvas.width, this.canvas.height);




                var img = new Image();
                img.src = this.image;
                 var w = window.innerWidth;
            var h = window.innerHeight;


                img.onload = function() {
                     var hImg = this.height;
                var wImg = this.width;

                var rAsp = wImg / hImg;
                console.log(rAsp);


                    if(w <= 1400 && w > 1280){
                        if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 1000, 562);
                        }else{
                            var newW = (562 * wImg) / hImg;
                            var newX = 1000 - newW;
                            ctx.drawImage(img,  newX / 2, 0, newW, 562);
                        }


                    }else if(w <= 1280 && w > 1000){

                          if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 1000, 562);
                        }else{
                            var newW = (562 * wImg) / hImg;
                             var newX = 1000 - newW;
                            ctx.drawImage(img,  newX / 2, 0, newW, 562);
                        }
                     }else if(w <= 1000){

                          if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 700, 394);
                        }else{
                            var newW = (394 * wImg) / hImg;
                             var newX = 700 - newW;
                            ctx.drawImage(img,  newX / 2, 0, newW, 394);
                        }
                    }else{
                        if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 1280, 720);
                        }else{
                            var newW = (720 * wImg) / hImg;
                            var newX = 1280 - newW;
                            ctx.drawImage(img, newX / 2, 0, newW, 720);
                        }

                    }

                }
            },
            cRedo() {
                var ctx = canvas.getContext("2d");

                this.cStep++
                if(this.cStep >= this.cPushArray.length){this.cStep = this.cPushArray.length -1}


                var img = new Image();
                img.src = this.image;
                 var w = window.innerWidth;
            var h = window.innerHeight;


                img.onload = function() {
                     var hImg = this.height;
                var wImg = this.width;

                var rAsp = wImg / hImg;
                console.log(rAsp);


                    if(w <= 1400 && w > 1280){
                        if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 1000, 562);
                        }else{
                            var newW = (562 * wImg) / hImg;
                            var newX = 1000 - newW;
                            ctx.drawImage(img,  newX / 2, 0, newW, 562);
                        }


                    }else if(w <= 1280 && w > 1000){

                          if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 1000, 562);
                        }else{
                            var newW = (562 * wImg) / hImg;
                             var newX = 1000 - newW;
                            ctx.drawImage(img,  newX / 2, 0, newW, 562);
                        }
                    }else if(w <= 1000){

                          if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 700, 394);
                        }else{
                            var newW = (394 * wImg) / hImg;
                             var newX = 700 - newW;
                            ctx.drawImage(img,  newX / 2, 0, newW, 394);
                        }
                    }else{
                        if(rAsp >= 1.77){
                            ctx.drawImage(img, 0, 0, 1280, 720);
                        }else{
                            var newW = (720 * wImg) / hImg;
                            var newX = 1280 - newW;
                            ctx.drawImage(img, newX / 2, 0, newW, 720);
                        }

                    }

                }
                var pos = this.cPushArray[this.cStep];
                console.log('ant: ' + pos);
                this.image = pos;
                this.ctx.clearRect(0,0, this.canvas.width, this.canvas.height);
            },
            oImg(id){
                document.getElementById('imgInput').alt = id;
                document.getElementById('imgInput').click();

            },
            oPalette(){
                document.getElementById('colorInput').click();
            },
            oBackInp(){
                document.getElementById('backInput').click();
            },
            saveFeedback(){
                console.log(canvas.toDataURL());
                if(this.client == null){
                    document.getElementById('clientSelect').style.border = '1px solid red';
                    return;
                }
                if(this.project == null){
                    document.getElementById('projectSelect').style.border = '1px solid red';
                    return;
                }
                document.getElementById('btnAddCom').disabled = true;
                document.getElementById('btnAddCom').style.backgroundColor = 'grey';
                axios.post('/addFeedback', {imgCanvas: canvas.toDataURL(), comments: this.comments, client: this.client, project: this.project})
                .then(response => {
                console.log('listo');
                window.location.href = "/";
                });
            },
            setFocus(id){
            var btns = document.getElementsByClassName('btnMenu');
            for (var i = 1; i <= 6; i++){ //assemble our info objects
                var bt = document.getElementById('btn'+i);
                bt.style.backgroundColor = '#39d2b4'
            }

            var btn = document.getElementById('btn'+id);
            btn.style.backgroundColor = '#34349e';
            },
            getProjects(){
                console.log(this.client);
                axios.get('/Feedback/getProjects/'+this.client)
            .then(response => {
                this.projects = response.data;
                console.log(this.projects);
            })
            }


        },

        mounted() {

            axios.get('/Feedback/getClients')
            .then(response => {
                this.clients = response.data;
                console.log(this.clients);
            })
            console.log(this.clients);
            this.canvas = document.getElementById("canvas");
            this.ctx = canvas.getContext("2d");
            this.menu = document.getElementById('menu');


            var w = window.innerWidth;
            var h = window.innerHeight;
            console.log(w,h);
            if(w <= 1400 && w > 1280){
                this.canvas.height = 562; //(window.innerHeight * 90) / 100;
                this.canvas.width =1000; //(window.innerWidth * 75) / 100;
            }else if(w <= 1280 && w > 1000){
                 this.canvas.height = 562; //(window.innerHeight * 90) / 100;
                this.canvas.width =1000; //(window.innerWidth * 75) / 100;
            }else if( w <= 1000){
                 this.canvas.height = 394; //(window.innerHeight * 90) / 100;
                this.canvas.width =700; //(window.innerWidth * 75) / 100;
            }else{
                this.canvas.height = 700; //(window.innerHeight * 90) / 100;
                this.canvas.width =1280; //(window.innerWidth * 75) / 100;
            }


            this.canvas.style.display = 'flex';
            this.canvas.style.float = 'left';

        },





    }
</script>
