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
        <div class="span9" style="float: none; margin: auto; padding: auto;">
            <div class="full-grid pull-left" style="margin-top: 20px;">
                <div style="text-align: center;margin:5px 0;" class="alert alert-info">
                    <span style="text-transform: uppercase; font-size: large;">Payment History</span>
                </div>
                <div style="text-align: center;margin:5px 0;">
                    <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Mode of Payment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $user_query=mysqli_query($conn,"SELECT * FROM payment_history WHERE member_id='$_SESSION[id]'")or die(mysqli_error($conn));
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
                            <?php $user_query=mysqli_query($conn,"SELECT * FROM payment_balance WHERE member_id='$_SESSION[id]'")or die(mysqli_error($conn));
                                while($row=mysqli_fetch_array($user_query)){?>
                                <tr>
                                    <td colspan="2"><span>Balance: </span></td>
                                    <td><span><?php echo $row['total_amount'];?></span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php $user_query=mysqli_query($conn,"SELECT * FROM dental_records WHERE member_id='$_SESSION[id]'")or die(mysqli_error($conn));
                while($row=mysqli_fetch_array($user_query)){?>
                <input  type="hidden" id="canvas_jsonData" value='<?php echo $row['canvas_data'];?>'>
                <div class="full-grid pull-left" style="margin-top: 20px;">
                    <div style="text-align: center;margin:5px 0;" class="alert alert-info">
                        <span style="text-transform: uppercase; font-size: large;">Dental Diagram</span>
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
                                <input readonly type="text" class="form-control" id="record-Tongue" value='<?php echo $row['tongue'];?>'>
                            </div>
                        </div>
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Palate">Palate</label>
                                <input readonly type="text" class="form-control" id="record-Palate" value='<?php echo $row['palate'];?>'>
                            </div>
                        </div>
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Tonsils">Tonsils</label>
                                <input readonly type="text" class="form-control" id="record-Tonsils" value='<?php echo $row['tonsils'];?>'>
                            </div>
                        </div>
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Lips">Lips</label>
                                <input readonly type="text" class="form-control" id="record-Lips" value='<?php echo $row['lips'];?>'>
                            </div>
                        </div>
                    </div>
                    <div style="margin:5px 0;">
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Mouth">Floor of Mouth</label>
                                <input readonly type="text" class="form-control" id="record-Mouth" value='<?php echo $row['floor_of_mouth'];?>'>
                            </div>
                        </div>
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Cheeks">Cheeks</label>
                                <input readonly type="text" class="form-control" id="record-Cheeks" value='<?php echo $row['cheeks'];?>'>
                            </div>
                        </div>
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Allergies">Allergies</label>
                                <input readonly type="text" class="form-control" id="record-Allergies" value='<?php echo $row['allergies'];?>'>
                            </div>
                        </div>
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Heart">Heart Disease</label>
                                <input readonly type="text" class="form-control" id="record-Heart" value='<?php echo $row['heart_disease'];?>'>
                            </div>
                        </div>
                    </div>
                    <div style="margin:5px 0;">
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Blood">Blood Dyscracia</label>
                                <input readonly type="text" class="form-control" id="record-Blood" value='<?php echo $row['blood_dyscracia'];?>'>
                            </div>
                        </div>
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Diabetes">Diabetes</label>
                                <input readonly type="text" class="form-control" id="record-Diabetes" value='<?php echo $row['diabetes'];?>'>
                            </div>
                        </div>
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Kidney">Kidney</label>
                                <input readonly type="text" class="form-control" id="record-Kidney" value='<?php echo $row['kidney'];?>'>
                            </div>
                        </div>
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Liver">Liver</label>
                                <input readonly type="text" class="form-control" id="record-Liver" value='<?php echo $row['liver'];?>'>
                            </div>
                        </div>
                    </div>
                    <div style="margin:5px 0;">
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Hygiene">Hygiene</label>
                                <input readonly type="text" class="form-control" id="record-Hygiene" value='<?php echo $row['hygiene'];?>'>
                            </div>
                        </div>
                        <div class="quarter-grid pull-left">
                            <div class="form-group">
                                <label for="record-Others">Others</label>
                                <input readonly type="text" class="form-control" id="record-Others" value='<?php echo $row['others'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Examination">Date of Examination (Annual)</label>
                                <input readonly type="text" class="form-control" id="record-Examination" value='<?php echo $row['date_of_examination'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Age">Age Last Birthday</label>
                                <input readonly type="text" class="form-control" id="record-Age" value='<?php echo $row['age_last_birthday'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Debris">Presence of Oral Debris</label>
                                <input readonly type="text" class="form-control" id="record-Debris" value='<?php echo $row['presence_of_oral_debris'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Calculus">Presence of Calculus</label>
                                <input readonly type="text" class="form-control" id="record-Calculus" value='<?php echo $row['presence_of_calculus'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Gingivitis">Presence of Gingivitis</label>
                                <input readonly type="text" class="form-control" id="record-Gingivitis" value='<?php echo $row['presence_of_gingivitis'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Periodontal">Presence of Periodontal Pocket</label>
                                <input readonly type="text" class="form-control" id="record-Periodontal" value='<?php echo $row['presence_of_periodontal_pocket'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-DentoFacial">Presence of DentoFacial Anomaly</label>
                                <input readonly type="text" class="form-control" id="record-DentoFacial" value='<?php echo $row['presence_of_dentoFacial_anomaly'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Toothbrush">Use Toothbrush</label>
                                <input readonly type="text" class="form-control" id="record-Toothbrush" value='<?php echo $row['use_toothbrush'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Filling">Caries Indicated for Filling</label>
                                <input readonly type="text" class="form-control" id="record-Filling" value='<?php echo $row['caries_indicated_for_filling'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Extraction">Caries Indicated for Extraction</label>
                                <input readonly type="text" class="form-control" id="record-Extraction" value='<?php echo $row['caries_indicated_for_extraction'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Fragment">Root Fragment</label>
                                <input readonly type="text" class="form-control" id="record-Fragment" value='<?php echo $row['root_fragment'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Missing">Missing due to Caries</label>
                                <input readonly type="text" class="form-control" id="record-Missing" value='<?php echo $row['missing_due_to_caries'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-FilledRestored">Filled or Restored</label>
                                <input readonly type="text" class="form-control" id="record-FilledRestored" value='<?php echo $row['filled_or_restored'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-MDF">Total MDF</label>
                                <input readonly type="text" class="form-control" id="record-MDF" value='<?php echo $row['total_MDF'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Flouride">Flouride Application</label>
                                <input readonly type="text" class="form-control" id="record-Flouride" value='<?php echo $row['flouride_application'];?>'>
                            </div>
                        </div>
                    </div>
                    <div  style="margin:5px 0;">
                        <div class="full-grid pull-left">
                            <div class="form-group">
                                <label for="record-Examiner">Examiner</label>
                                <input readonly type="text" class="form-control" id="record-Examiner" value='<?php echo $row['examiner'];?>'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="full-grid pull-left" style="margin-top: 20px;">
                    <div style="text-align: center;margin:5px 0;">
                        <span style="text-transform: uppercase; font-size: large;">Remarks</span>
                        <textarea readonly name="dental_comments" id="dental_comments" style="width: 100%;height: 300px; resize: none;" placeholder="Comments here...."><?php echo $row["comments"]; ?></textarea>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        // using fabric.js library for canvas
        let canvas = this.__canvas = new fabric.Canvas('canvas', {
            selection: false
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
                canvas._objects.forEach(function(obj){
                    obj.selectable = false;
                    obj.evented = false;
                    obj.hasRotatingPoint = false;
                    obj.erasable = false;
                });
                canvas.renderAll(); 
            },function(o,object){});
        }
    });
</script>