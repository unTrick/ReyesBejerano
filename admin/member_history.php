<?php include('header.php'); ?>
<?php include('session.php'); ?>
    <div class="container">

	<div class="row">	
        <div class="full-grid" style="text-align: center;">
            <img src="../img/dr.png" class="img-rounded">
        </div>
        <div class="span3">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="span9">
            <?php include('navbar_dasboard.php') ?>

            <input type="hidden" id="member_id" value="<?php echo $_GET['id'];?>">
            <?php $user_query=mysqli_query($conn,"SELECT * FROM dental_records WHERE member_id='$_GET[id]'")or die(mysqli_error($conn));
            while($row=mysqli_fetch_array($user_query)){?>
                <input  type="hidden" id="canvas_jsonData" value='<?php echo $row['canvas_data'];?>'>
                <div class="full-grid pull-left" id="options">
                    <div id="drawing-mode-options">
                        <div class="pull-left" style="margin: 0px 10px;">
                            <label for="drawing-line-width">Line width</label>
                            <span class="text" id="slider"> 15 </span> <input type="range" value="15" min="0" max="150" id="drawing-line-width">
                        </div>
                        <div class="pull-left" style="margin: 0px 10px;">
                            <label for="drawing-color">Line color</label>
                            <input type="text" class="form-control" value="#000000" id="drawing-color">
                        </div>
                        <div class="pull-left" style="margin: 0px 10px;">
                            <label for="drawing-eraser">Eraser</label>
                            <input type="checkbox" class="form-check-input" id="drawing-eraser">
                        </div>
                    </div>
                </div>
                <div class="full-grid pull-left" style="margin-top: 20px;">
                    <div id="canvas-container" oncontextmenu="return false" style="overflow: auto; height: 650px; outline: none; background-color: white;">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
                <div class="full-grid pull-left" style="margin-top: 20px;">
                    <div style="text-align: center;margin:5px 0;">
                        <span style="text-transform: uppercase; font-size: large;">Physical and Medical History</span>
                    </div>
                    <div style="margin:5px 0;">
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Tongue">Tongue</label>
                                <input type="text" class="form-control" id="record-Tongue">
                            </div>
                        </div>
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Palate">Palate</label>
                                <input type="text" class="form-control" id="record-Palate">
                            </div>
                        </div>
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Tonsils">Tonsils</label>
                                <input type="text" class="form-control" id="record-Tonsils">
                            </div>
                        </div>
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Lips">Lips</label>
                                <input type="text" class="form-control" id="record-Lips">
                            </div>
                        </div>
                    </div>
                    <div style="margin:5px 0;">
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Mouth">Floor of Mouth</label>
                                <input type="text" class="form-control" id="record-Mouth">
                            </div>
                        </div>
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Cheeks">Cheeks</label>
                                <input type="text" class="form-control" id="record-Cheeks">
                            </div>
                        </div>
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Allergies">Allergies</label>
                                <input type="text" class="form-control" id="record-Allergies">
                            </div>
                        </div>
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Heart">Heart Disease</label>
                                <input type="text" class="form-control" id="record-Heart">
                            </div>
                        </div>
                    </div>
                    <div style="margin:5px 0;">
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Blood">Blood Dyscracia</label>
                                <input type="text" class="form-control" id="record-Blood">
                            </div>
                        </div>
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Diabetes">Diabetes</label>
                                <input type="text" class="form-control" id="record-Diabetes">
                            </div>
                        </div>
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Kidney">Kidney</label>
                                <input type="text" class="form-control" id="record-Kidney">
                            </div>
                        </div>
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Liver">Liver</label>
                                <input type="text" class="form-control" id="record-Liver">
                            </div>
                        </div>
                    </div>
                    <div style="margin:5px 0;">
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Hygiene">Hygiene</label>
                                <input type="text" class="form-control" id="record-Hygiene">
                            </div>
                        </div>
                        <div class="quarter-grid">
                            <div class="form-group">
                                <label for="record-Others">Others</label>
                                <input type="text" class="form-control" id="record-Others">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="full-grid pull-left" style="margin-top: 20px;">
                    <div style="text-align: center;margin:5px 0;">
                        <span style="text-transform: uppercase; font-size: large;">Remarks</span>
                        <textarea name="dental_comments" id="dental_comments" style="width: 100%;height: 300px; resize: none;" placeholder="Comments here...."><?php echo $row["comments"]; ?></textarea>
                    </div>
                    <div style=" text-align: center;">
                        <button type="button" id="save-records" class="btn btn-success">SAVE RECORDS</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<script>
    $(document).ready(function(){

        // using fabric.js library for canvas
        let canvas = this.__canvas = new fabric.Canvas('canvas', {
            isDrawingMode: true
        });

        // set the canvas width and height
        let canvasWidth = $("#canvas-container").width();
        let canvasHeight = $("#canvas-container").height();
        canvas.setWidth(canvasWidth);
        canvas.setHeight(canvasHeight);

        const canvas_jsonData = $("#canvas_jsonData").val();
        if(typeof canvas_jsonData == "undefined" || canvas_jsonData == ""){
            // load the background image or the dental image diagram if the user doesn't have previous records
            fabric.Image.fromURL("../img/dental_diagram.png", function (img){
                const center = { x: canvasWidth/2, y: canvasHeight/2};
                const imgScaleX = canvasHeight/img.width;

                img.set({
                    hasRotatingPoint: false, evented: false, selectable: false, stroke: 1, strokeDashArray: [5, 5], strokewidth:2,
                    "scaleX": parseFloat(imgScaleX), left: center.x - ((img.width*imgScaleX)/2), top: center.y - (img.height/2), erasable: false
                });
                img.setCoords();
                canvas.add(img);
                canvas.sendToBack(img);
            });
        }
        else {
            // if the user already has existing records then just get the canvas data and render it
            canvas.loadFromJSON(canvas_jsonData, function() {
                canvas.renderAll(); 
            },function(o,object){});
        }
        
        let drawingColorEl = $("#drawing-color"),
            drawingLineWidthEl = $("#drawing-line-width"),
            drawingEraserEl = $("#drawing-eraser");

        // using spectrum.js library for color picker
        drawingColorEl.spectrum({
            preferredFormat: "hex",
            set: "#000000",
            showInput: true,
            showAlpha: false,
            showPalette: true,
            allowEmpty: false,
            palette: [
                ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
                ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
                ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
                ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
                ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
                ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
                ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
                ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
            ]
        });

        // this is to change the color of the brush
        drawingColorEl.on("change", function(){
            let brush = canvas.freeDrawingBrush;
            brush.color = $(this).val();
            if (brush.getPatternSrc) {
                brush.source = brush.getPatternSrc.call(brush);
            }
        });

        // this is to change the value of the slider
        drawingLineWidthEl.on("change", function(){
            canvas.freeDrawingBrush.width = parseInt($(this).val(), 10) || 1;
            $("#slider").text($(this).val());
        });

        // this is to turn the eraser on and off
        drawingEraserEl.on("change", function(){
            if($(this).is(":checked")){
                canvas.freeDrawingBrush = new fabric.EraserBrush(canvas);
                canvas.isDrawingMode = true;
                canvas.freeDrawingBrush.width = parseInt(drawingLineWidthEl.val(), 10) || 1;
            }
            else {
                canvas.freeDrawingBrush = new fabric.PencilBrush(canvas);
                canvas.isDrawingMode = true;
                canvas.freeDrawingBrush.width = parseInt(drawingLineWidthEl.val(), 10) || 1;
            }
        });

        // this to render the value of the brush color and slider value on load
        canvas.freeDrawingBrush.color = drawingColorEl.val();
        canvas.freeDrawingBrush.width = parseInt(drawingLineWidthEl.val(), 10) || 1;

        $("#save-records").on("click", function(){
            const id = $("#member_id").val();
            const comments = $("#dental_comments").val();
            const canvas_data = String(JSON.stringify(canvas));
            $.ajax({
                type: "POST",
                url: "save_canvas.php",
                data: {
                    id: id,
                    comments: comments,
                    data: canvas_data
                },
                cache: false,
                success: function(html){
                    //TODO .. alert or notify message here
                    alert("changes have been saved successfully");
                },
                error: function (request, status, error) {
                    //catch the error message here
                    //console.log(request.responseText);
                }
                
            }); 
        });
    });
</script>
<?php include('footer.php') ?>