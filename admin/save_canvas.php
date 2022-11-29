<?php
    include('dbcon.php');
    $id=$_POST['id'];
    $comments=mysqli_real_escape_string($conn, $_POST['dental_comments']); // legalized special characters using mysqli_real_escape_string for the SQL to accept the inputed value  
    $data=mysqli_real_escape_string($conn, $_POST['data']); // legalized special characters using mysqli_real_escape_string for the SQL to accept the inputed value
    $tongue=$_POST['tongue'];
    $palate=$_POST['palate'];
    $tonsils=$_POST['tonsils'];
    $lips=$_POST['lips'];
    $floor_of_mouth=$_POST['floor_of_mouth'];
    $cheeks=$_POST['cheeks'];
    $allergies=$_POST['allergies'];
    $heart_disease=$_POST['heart_disease'];
    $blood_dyscracia=$_POST['blood_dyscracia'];
    $diabetes=$_POST['diabetes'];
    $kidney=$_POST['kidney'];
    $liver=$_POST['liver'];
    $hygiene=$_POST['hygiene'];
    $others=$_POST['others'];
    $date_of_examination=$_POST['date_of_examination'];
    $age_last_birthday=$_POST['age_last_birthday'];
    $presence_of_oral_debris=$_POST['presence_of_oral_debris'];
    $presence_of_calculus=$_POST['presence_of_calculus'];
    $presence_of_gingivitis=$_POST['presence_of_gingivitis'];
    $presence_of_periodontal_pocket=$_POST['presence_of_periodontal_pocket'];
    $presence_of_dentoFacial_anomaly=$_POST['presence_of_dentoFacial_anomaly'];
    $use_toothbrush=$_POST['use_toothbrush'];
    $caries_indicated_for_filling=$_POST['caries_indicated_for_filling'];
    $caries_indicated_for_extraction=$_POST['caries_indicated_for_extraction'];
    $root_fragment=$_POST['root_fragment'];
    $missing_due_to_caries=$_POST['missing_due_to_caries'];
    $filled_or_restored=$_POST['filled_or_restored'];
    $total_MDF=$_POST['total_MDF'];
    $flouride_application=$_POST['flouride_application'];
    $examiner=$_POST['examiner'];

    $user_query=mysqli_query($conn,"SELECT * FROM dental_records WHERE member_id='$id'")or die(mysqli_error($conn));
    
    // first check if the user already has previous records
    if($row=mysqli_fetch_array($user_query)) {
        mysqli_query($conn,"UPDATE dental_records SET 
        canvas_data='$data', 
        comments='$comments', 
        tongue='$tongue', 
        palate='$palate', 
        tonsils='$tonsils', 
        lips='$lips', 
        floor_of_mouth='$floor_of_mouth', 
        cheeks='$cheeks', 
        allergies='$allergies', 
        heart_disease='$heart_disease', 
        blood_dyscracia='$blood_dyscracia', 
        diabetes='$diabetes', 
        kidney='$kidney', 
        liver='$liver', 
        hygiene='$hygiene', 
        others='$others', 
        date_of_examination='$date_of_examination', 
        age_last_birthday='$age_last_birthday', 
        presence_of_oral_debris='$presence_of_oral_debris', 
        presence_of_calculus='$presence_of_calculus', 
        presence_of_gingivitis='$presence_of_gingivitis', 
        presence_of_periodontal_pocket='$presence_of_periodontal_pocket', 
        presence_of_dentoFacial_anomaly='$presence_of_dentoFacial_anomaly', 
        use_toothbrush='$use_toothbrush', 
        caries_indicated_for_filling='$caries_indicated_for_filling', 
        caries_indicated_for_extraction='$caries_indicated_for_extraction', 
        root_fragment='$root_fragment', 
        missing_due_to_caries='$missing_due_to_caries', 
        filled_or_restored='$filled_or_restored', 
        total_MDF='$total_MDF', 
        flouride_application='$flouride_application', 
        examiner='$examiner'
        WHERE member_id='$id'") or die(mysqli_error($conn));
    }
    else{
        mysqli_query($conn,"INSERT INTO dental_records 
        (
            comments, 
            canvas_data, 
            member_id, 
            tongue, 
            palate, 
            tonsils, 
            lips, 
            floor_of_mouth, 
            cheeks, 
            allergies, 
            heart_disease, 
            blood_dyscracia, 
            diabetes, 
            kidney, 
            liver, 
            hygiene, 
            others, 
            date_of_examination, 
            age_last_birthday, 
            presence_of_oral_debris, 
            presence_of_calculus, 
            presence_of_gingivitis, 
            presence_of_periodontal_pocket, 
            presence_of_dentoFacial_anomaly, 
            use_toothbrush, 
            caries_indicated_for_filling, 
            caries_indicated_for_extraction, 
            root_fragment, 
            missing_due_to_caries, 
            filled_or_restored, 
            total_MDF, 
            flouride_application, 
            examiner
        ) 
            VALUES 
            (
                '$comments', 
                '$data', 
                '$id', 
                '$tongue', 
                '$palate', 
                '$tonsils', 
                '$lips', 
                '$floor_of_mouth', 
                '$cheeks', 
                '$allergies', 
                '$heart_disease', 
                '$blood_dyscracia', 
                '$diabetes', 
                '$kidney', 
                '$liver', 
                '$hygiene', 
                '$others', 
                '$date_of_examination', 
                '$age_last_birthday', 
                '$presence_of_oral_debris', 
                '$presence_of_calculus', 
                '$presence_of_gingivitis', 
                '$presence_of_periodontal_pocket', 
                '$presence_of_dentoFacial_anomaly', 
                '$use_toothbrush', 
                '$caries_indicated_for_filling', 
                '$caries_indicated_for_extraction', 
                '$root_fragment', 
                '$missing_due_to_caries', 
                '$filled_or_restored', 
                '$total_MDF', 
                '$flouride_application', 
                '$examiner'
            )") or die(mysqli_error($conn));
    }
?>