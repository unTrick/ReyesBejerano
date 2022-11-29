<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>
<div class="container">
    <div class="margin-top">
        <div class="row">
            <div class="full-grid" style="text-align: center;">
                <img src="img/dr.png">
            </div>
        </div>
        <?php $user_query=mysqli_query($conn,"SELECT * FROM dental_records WHERE member_id='$_SESSION[id]'")or die(mysqli_error($conn));
            while($row=mysqli_fetch_array($user_query)){?>
            <input  type="hidden" id="canvas_jsonData" value='<?php echo $row['canvas_data'];?>'>
            <div class="row">
                <div class="span9" style="float: none; margin: auto; padding: auto;">
                    <div class="full-grid" style="text-align: center;">
                        <div class="row">
                            <div class="full-grid">
                                <div class="alert alert-info">Dental Diagram</div>
                                <div class="full-grid pull-left" style="margin-top: 20px;">
                                    <div id="canvas-container" oncontextmenu="return false" style="overflow: auto; height: 650px; outline: none; background-color: white;">
                                        <canvas id="canvas"></canvas>
                                    </div>
                                </div>
                                <div class="full-grid pull-left" style="margin-top: 20px;">
                                    <div style="text-align: center;margin:5px 0;">
                                        <span style="text-transform: uppercase; font-size: large;">Remarks</span>
                                        <textarea name="dental_comments" id="dental_comments" readonly style="width: 100%;height: 300px; resize: none;" placeholder="Comments here...."><?php echo $row["comments"]; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="full-grid">
                                <div class="alert alert-info">Dental History</div>
                                <div class="full-grid pull-left" style="margin-top: 20px;">
                                    <div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    });
</script>