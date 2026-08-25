<?php

include "config.php";

$student = null;
$error = "";

if (isset($_POST['verify'])) {

    $certificate_id = trim($_POST['certificate_id']);

    if ($certificate_id == "") {

        $error = "Please enter your Certificate Number.";

    } else {

        $certificate_id = mysqli_real_escape_string($conn, $certificate_id);

        $query = "SELECT * FROM students 
                  WHERE certificate_id = '$certificate_id'
                  LIMIT 1";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            $student = mysqli_fetch_assoc($result);

        } else {

            $error = "Invalid Certificate ID. Certificate not found.";

        }
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Verify Certificate</title>


<style>

/* =========================
   GENERAL
========================= */

*{
    box-sizing:border-box;
}

body{

    margin:0;

    padding:0;

    font-family:Arial, Helvetica, sans-serif;

    background:#031232;

    color:#333;

}


/* =========================
   MAIN CONTAINER
========================= */

.verify-container{

    width:88%;

    max-width:1100px;

    margin:55px auto;

    background:#fff;

    padding:50px;

    border-radius:6px;

    box-shadow:0 2px 12px rgba(0,0,0,0.18);

}


/* =========================
   HEADING
========================= */

.verify-container h1{

    text-align:center;

    font-size:43px;

    color:#2563eb;

    margin:0 0 50px;

}


/* =========================
   SEARCH FORM
========================= */

.verify-form{

    max-width:735px;

    margin:auto;

}

.verify-form input{

    width:100%;

    height:65px;

    padding:0 15px;

    border:none;

    border-bottom:1px solid #2563eb;

    outline:none;

    font-size:24px;

    color:#555;

}

.verify-form input::placeholder{

    color:#888;

}


.verify-form button{

    display:block;

    margin:42px auto 0;

    padding:18px 55px;

    border:none;

    border-radius:40px;

    background:#2563eb;

    color:white;

    font-size:28px;

    cursor:pointer;

    transition:0.3s;

}

.verify-form button:hover{

    background:#2563eb;

}


/* =========================
   ERROR
========================= */

.error{

    max-width:735px;

    margin:30px auto 0;

    padding:16px;

    text-align:center;

    background:#ffe5e8;

    color:#c6283d;

    border-radius:5px;

    font-size:18px;

}


/* =========================
   CERTIFICATE
========================= */

.certificate-result{

    width:100%;

    margin:45px auto 0;

    text-align:center;

}


.certificate-preview{

    position:relative;

    width:100%;

    max-width:900px;

    margin:auto;

    aspect-ratio:1123 / 794;

    overflow:hidden;

    background:#fff;

    box-shadow:0 4px 18px rgba(0,0,0,0.25);

}


/* Certificate Background */

.certificate-bg{

    position:absolute;

    top:0;

    left:0;

    width:100%;

    height:100%;

    display:block;

}


/* =========================
   STUDENT NAME
========================= */

.student-name{

    position:absolute;

    top:40%;

    left:0;

    width:51%;

    text-align:center;

    font-family:Georgia, "Times New Roman", serif;

    font-size:25px;

    color:#d52f3f;

    font-family: "Times New Roman", serif;

    font-weight: 400;

}


/* =========================
   CERTIFICATE ID
========================= */

.certificate-id{

    position:absolute;

    top:45%;

    left:55%;

    width:36%;

    text-align:center;

    font-size:16px;

    font-weight:bold;

    color:#111;

    font-family: "Times New Roman", serif;

    font-weight: 400;

}


/* =========================
   COURSE
========================= */

.course-name{

    position:absolute;

    top:52%;

    left:0;

    width:51%;

    text-align:center;

    font-family: "Times New Roman", serif;

     font-weight: bold;

    font-size:22px;

    font-weight:400;

    color:#d52f3f;

}


/* =========================
   START DATE
========================= */

.start-date{

    position:absolute;

    top:66.5%;

    left:55%;

    width:16%;

    text-align:center;

    font-size:15px;

    font-weight:400;

    color:#111;

}


/* =========================
   END DATE
========================= */

.end-date{

    position:absolute;

    top:66.5%;

    left:72%;

    width:16%;

    text-align:center;

    font-size:15px;

    font-weight:400;

    color:#111;

}


/* =========================
   BUTTONS
========================= */

.certificate-buttons{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:18px;

    margin-top:30px;

}


.print-btn,
.download-btn{

    border:none;

    padding:14px 28px;

    border-radius:5px;

    font-size:16px;

    font-weight:bold;

    cursor:pointer;

    text-decoration:none;

    display:inline-block;

}


.print-btn{

    background:#2864e8;

    color:#fff;

}


.download-btn{

    background:#2864e8;

    color:#fff;

}


.print-btn:hover,
.download-btn:hover{

    opacity:0.85;

}
/* Certificate ID */

.certificate-id{

    position:absolute;

    top:52%;

    left:57%;

    width:30%;

    text-align:start;

    font-size:18px;

    font-weight:bold;

    color:#111;

    padding-bottom:7px;

    border-bottom:2px solid #245b5b;

}


/* Start Date */



.start-date {
    position: absolute;

    top: 360px;
    left: 510px;

    width: 270px;

    text-align: start;

    font-family: "Times New Roman", serif;

    font-size: 18px;

    font-weight: bold;

    color: #111;

    padding-bottom: 8px;

    border-bottom: 2px solid #245b5b;
}


.end-date {
    position: absolute;

    top: 400px;
    left: 510px;

    width: 270px;

    text-align: start;

    font-family: "Times New Roman", serif;

    font-size: 18px;

    font-weight: bold;

    color: #111;

    padding-bottom: 8px;

    border-bottom: 2px solid #245b5b;
}
/* =========================
   PRINT
========================= */

@media print{

    body{

        background:#fff;

    }


    .verify-container{

        width:100%;

        max-width:none;

        margin:0;

        padding:0;

        box-shadow:none;

    }


    .verify-container > h1,
    .verify-form,
    .error,
    .certificate-buttons{

        display:none !important;

    }


    .certificate-result{

        margin:0;

    }


    .certificate-preview{

        width:100%;

        max-width:none;

        box-shadow:none;

    }

}


/* =========================
   MOBILE
========================= */

@media(max-width:600px){

    .verify-container{

        width:94%;

        padding:30px 18px;

        margin:30px auto;

    }


    .verify-container h1{

        font-size:30px;

        margin-bottom:35px;

    }


    .verify-form input{

        height:55px;

        font-size:18px;

    }


    .verify-form button{

        font-size:20px;

        padding:15px 40px;

        margin-top:30px;

    }


    .certificate-buttons{

        flex-direction:column;

    }


    .print-btn,
    .download-btn{

        width:100%;

        max-width:280px;

        text-align:center;

    }


    .student-name{

        font-size:14px;

    }


    .certificate-id{

        font-size:9px;

    }


    .course-name{

        font-size:13px;

    }


    .start-date,
    .end-date{

        font-size:8px;

    }

}

</style>

</head>


<body> 

<div class="verify-container">


    <h1>
        Enter Your Certificate Number
    </h1>


    <!-- SEARCH FORM -->

    <form
        method="POST"
        class="verify-form"
    >

        <input
            type="text"
            name="certificate_id"
            placeholder="Enter your Certificate Number"
            value="<?php echo isset($_POST['certificate_id']) ? htmlspecialchars($_POST['certificate_id']) : ''; ?>"
            required
        >


        <button
            type="submit"
            name="verify"
        >
            Search
        </button>

    </form>


    <!-- ERROR -->

    <?php if ($error != "") { ?>

        <div class="error">

            <?php echo htmlspecialchars($error); ?>

        </div>

    <?php } ?>


    <!-- CERTIFICATE -->

    <?php if ($student) { ?>


        <div class="certificate-result">


            <div class="certificate-preview">


                <!-- ORIGINAL CERTIFICATE IMAGE -->

                <img
                    src="images/certificate_template.png2.png"
                    class="certificate-bg"
                    alt="Certificate"
                >


                <!-- STUDENT NAME -->

                <div class="student-name">

                    <?php echo htmlspecialchars(ucwords(strtolower(trim($student['student_name'])))); ?>

                </div>


                <!-- CERTIFICATE ID -->

                <div class="certificate-id">

                    Certificate ID :
                    <?php
                    echo htmlspecialchars($student['certificate_id']);
                    ?>

                </div>


                <!-- COURSE -->

                <div class="course-name">

                    <?php
                    echo htmlspecialchars($student['course']);
                    ?>

                </div>


               <!-- START DATE -->

<div class="start-date">

    Start Date :
    <?php
    echo date(
        "d M Y",
        strtotime($student['start_date'])
    );
    ?>

</div>


<!-- END DATE -->

<div class="end-date">

    End Date :
    <?php
    echo date(
        "d M Y",
        strtotime($student['end_date'])
    );
    ?>

</div>
            </div>

            <!-- BUTTONS -->

            <div class="certificate-buttons">


                <!-- PRINT -->

                <button
                    type="button"
                    onclick="window.print()"
                    class="print-btn"
                >

                    🖨 Print Certificate

                </button>


                <!-- DOWNLOAD -->

                <a
                    href="admin/download_certificate.php?id=<?php echo (int)$student['id']; ?>"
                    class="download-btn"
                >

                    ↓ Download PDF

                </a>


            </div>


        </div>


    <?php } ?>


</div>


</body>

</html>