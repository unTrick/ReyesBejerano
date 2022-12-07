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

            <div class="full-grid pull-left" style="margin-top: 20px;">
                <div style="text-align: center;margin:5px 0;" class="alert alert-info">
                    <span style="text-transform: uppercase; font-size: large;">Payment History</span>
                </div>
                <div style="text-align: center;margin:5px 0;">
                    <div class="full-grid" style="text-align: right; margin: 10px 0px;">
                        <span id="balance-alert-message" style="display: none;">Balance Updated Successfully</span>
                        <button type="button" id="add-balance" class="btn btn-primary">Add Balance</button>
                    </div>
                    <div class="full-grid" id="balance-form" style="display: none; margin: 10px 0px;">
                        <input type="hidden" id="member-id-balance" value="<?php echo $_GET['id'];?>">
                        <?php $balance_query=mysqli_query($conn,"SELECT * FROM payment_balance WHERE member_id='$_GET[id]'")or die(mysqli_error($conn));
                             while($balance_row=mysqli_fetch_array($balance_query)){?>
                                <input type="hidden" id="current-balance" value="<?php echo $balance_row['total_amount'];?>">
                            <?php } ?>
                        <div class="control-group">
                            <label for="balance-amount">Amount to be added</label>
                            <input type="number" id="balance-amount" name="balance_amount" value="">
                        </div>
                        <button type="button" id="save-updated-balance" class="btn btn-success" style="display: inline-block;">Save</button>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Mode of Payment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $user_query=mysqli_query($conn,"SELECT * FROM payment_history WHERE member_id='$_GET[id]'")or die(mysqli_error($conn));
                                while($row=mysqli_fetch_array($user_query)){?>
                                <tr>
                                    <td><span><?php echo $row['amount'];?></span></td>
                                    <td><span><?php echo $row['mode_of_payment'];?></span></td>
                                    <td><span><?php echo $row['date'];?></span></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3"></td> 
                            </tr>
                            <?php $user_query=mysqli_query($conn,"SELECT * FROM payment_balance WHERE member_id='$_GET[id]'")or die(mysqli_error($conn));
                             while($row=mysqli_fetch_array($user_query)){?>
                                <tr>
                                    <td colspan="2"><span>Balance: </span></td>
                                    <td><span id="total-balance-amount"><?php echo $row['total_amount'];?></span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <form id="dental_records_form">
                <input type="hidden" id="member_id" value="<?php echo $_GET['id'];?>">
                <?php $user_query=mysqli_query($conn,"SELECT * FROM dental_records WHERE member_id='$_GET[id]'")or die(mysqli_error($conn));
                while($row=mysqli_fetch_array($user_query)){?>
                    <input  type="hidden" id="canvas_jsonData" value='<?php echo $row['canvas_data'];?>'>
                    <div class="full-grid pull-left" style="margin-top: 20px;">
                        <div style="text-align: center;margin:5px 0;" class="alert alert-info">
                            <span style="text-transform: uppercase; font-size: large;">Dental Diagram</span>
                        </div>
                    </div>
                    <div class="full-grid pull-left" id="options" style="">
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
                        <div style="text-align: center;margin:5px 0;" class="alert alert-info">
                            <span style="text-transform: uppercase; font-size: large;">Physical and Medical History</span>
                        </div>
                        <div style="margin:5px 0;">
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Tongue">Tongue</label>
                                    <input type="text" class="form-control" id="record-Tongue" name="tongue" value='<?php echo $row['tongue'];?>'>
                                </div>
                            </div>
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Palate">Palate</label>
                                    <input type="text" class="form-control" id="record-Palate" name="palate" value='<?php echo $row['palate'];?>'>
                                </div>
                            </div>
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Tonsils">Tonsils</label>
                                    <input type="text" class="form-control" id="record-Tonsils" name="tonsils" value='<?php echo $row['tonsils'];?>'>
                                </div>
                            </div>
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Lips">Lips</label>
                                    <input type="text" class="form-control" id="record-Lips" name="lips" value='<?php echo $row['lips'];?>'>
                                </div>
                            </div>
                        </div>
                        <div style="margin:5px 0;">
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Mouth">Floor of Mouth</label>
                                    <input type="text" class="form-control" id="record-Mouth" name="floor_of_mouth" value='<?php echo $row['floor_of_mouth'];?>'>
                                </div>
                            </div>
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Cheeks">Cheeks</label>
                                    <input type="text" class="form-control" id="record-Cheeks" name="cheeks" value='<?php echo $row['cheeks'];?>'>
                                </div>
                            </div>
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Allergies">Allergies</label>
                                    <input type="text" class="form-control" id="record-Allergies" name="allergies" value='<?php echo $row['allergies'];?>'>
                                </div>
                            </div>
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Heart">Heart Disease</label>
                                    <input type="text" class="form-control" id="record-Heart" name="heart_disease" value='<?php echo $row['heart_disease'];?>'>
                                </div>
                            </div>
                        </div>
                        <div style="margin:5px 0;">
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Blood">Blood Dyscracia</label>
                                    <input type="text" class="form-control" id="record-Blood" name="blood_dyscracia" value='<?php echo $row['blood_dyscracia'];?>'>
                                </div>
                            </div>
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Diabetes">Diabetes</label>
                                    <input type="text" class="form-control" id="record-Diabetes" name="diabetes" value='<?php echo $row['diabetes'];?>'>
                                </div>
                            </div>
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Kidney">Kidney</label>
                                    <input type="text" class="form-control" id="record-Kidney" name="kidney" value='<?php echo $row['kidney'];?>'>
                                </div>
                            </div>
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Liver">Liver</label>
                                    <input type="text" class="form-control" id="record-Liver" name="liver" value='<?php echo $row['liver'];?>'>
                                </div>
                            </div>
                        </div>
                        <div style="margin:5px 0;">
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Hygiene">Hygiene</label>
                                    <input type="text" class="form-control" id="record-Hygiene" name="hygiene" value='<?php echo $row['hygiene'];?>'>
                                </div>
                            </div>
                            <div class="quarter-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Others">Others</label>
                                    <input type="text" class="form-control" id="record-Others" name="others" value='<?php echo $row['others'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Examination">Date of Examination (Annual)</label>
                                    <input type="text" class="form-control" id="record-Examination" name="date_of_examination" value='<?php echo $row['date_of_examination'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Age">Age Last Birthday</label>
                                    <input type="text" class="form-control" id="record-Age" name="age_last_birthday" value='<?php echo $row['age_last_birthday'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Debris">Presence of Oral Debris</label>
                                    <input type="text" class="form-control" id="record-Debris" name="presence_of_oral_debris" value='<?php echo $row['presence_of_oral_debris'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Calculus">Presence of Calculus</label>
                                    <input type="text" class="form-control" id="record-Calculus" name="presence_of_calculus" value='<?php echo $row['presence_of_calculus'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Gingivitis">Presence of Gingivitis</label>
                                    <input type="text" class="form-control" id="record-Gingivitis" name="presence_of_gingivitis" value='<?php echo $row['presence_of_gingivitis'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Periodontal">Presence of Periodontal Pocket</label>
                                    <input type="text" class="form-control" id="record-Periodontal" name="presence_of_periodontal_pocket" value='<?php echo $row['presence_of_periodontal_pocket'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-DentoFacial">Presence of DentoFacial Anomaly</label>
                                    <input type="text" class="form-control" id="record-DentoFacial" name="presence_of_dentoFacial_anomaly" value='<?php echo $row['presence_of_dentoFacial_anomaly'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Toothbrush">Use Toothbrush</label>
                                    <input type="text" class="form-control" id="record-Toothbrush" name="use_toothbrush" value='<?php echo $row['use_toothbrush'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Filling">Caries Indicated for Filling</label>
                                    <input type="text" class="form-control" id="record-Filling" name="caries_indicated_for_filling" value='<?php echo $row['caries_indicated_for_filling'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Extraction">Caries Indicated for Extraction</label>
                                    <input type="text" class="form-control" id="record-Extraction" name="caries_indicated_for_extraction" value='<?php echo $row['caries_indicated_for_extraction'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Fragment">Root Fragment</label>
                                    <input type="text" class="form-control" id="record-Fragment" name="root_fragment" value='<?php echo $row['root_fragment'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Missing">Missing due to Caries</label>
                                    <input type="text" class="form-control" id="record-Missing" name="missing_due_to_caries" value='<?php echo $row['missing_due_to_caries'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-FilledRestored">Filled or Restored</label>
                                    <input type="text" class="form-control" id="record-FilledRestored" name="filled_or_restored" value='<?php echo $row['filled_or_restored'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-MDF">Total MDF</label>
                                    <input type="text" class="form-control" id="record-MDF" name="total_MDF" value='<?php echo $row['total_MDF'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Flouride">Flouride Application</label>
                                    <input type="text" class="form-control" id="record-Flouride" name="flouride_application" value='<?php echo $row['flouride_application'];?>'>
                                </div>
                            </div>
                        </div>
                        <div  style="margin:5px 0;">
                            <div class="full-grid pull-left">
                                <div class="form-group">
                                    <label for="record-Examiner">Examiner</label>
                                    <input type="text" class="form-control" id="record-Examiner" name="examiner" value='<?php echo $row['examiner'];?>'>
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
            </form>
        </div>
    </div>
<script>
    $(document).ready(function(){

        // make the add balance form visible
        $("#add-balance").on("click", function(){
            $("#balance-form").toggle("slow");
        });

        $("#save-updated-balance").on("click", function(){
            const member_id_balance = $("#member-id-balance").val();
            const balance_amount = $("#balance-amount").val();
            const current_balance = $("#current-balance").val();
            $.ajax({
                type: "POST",
                url: "update_member_balance.php",
                data: {
                    member_id: member_id_balance,
                    balance_amount: balance_amount,
                    current_balance: current_balance
                },
                cache: false,
                success: function(result){
                    $("#total-balance-amount").text(result);
                    $("#balance-form").toggle("slow");

                    $("#balance-alert-message").show();
                    setTimeout(function(){
                        $("#balance-alert-message").hide();
                    }, 5000);
                },
                error: function (request, status, error) {
                    //catch the error message here
                    //console.log(request.responseText);
                }
                
            }); 
        });

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
            const canvas_data = String(JSON.stringify(canvas));
            const formData = $("#dental_records_form");
            $.ajax({
                type: "POST",
                url: "save_canvas.php",
                data: formData.serialize()+"&id="+id+"&data="+canvas_data,
                cache: false,
                success: function(result){
                    // .. alert or notify message here
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