<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include your database connection code here

// Fetch user information from the database if needed
// Replace this with your actual database query
$user_id = $_SESSION['user_id'];
// Example query to fetch user info
// $query = "SELECT * FROM user WHERE id = $user_id";
// Execute your query and fetch user data as needed

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="SREC_logo.png" type="image/ico">
    <script src="https://rawgit.com/evidenceprime/html-docx-js/master/dist/html-docx.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>

</head>

<body>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpd4K-pjmQUKAGuVfJ3ynKc7tySLlVX_7Slw&usqp=CAU"
        alt="SREC_logo.png"
        style="width:150px;height:150px; text-align:center; font-size: 5rem; margin: 18px; float: left; max-width: 100%; max-height: 100%; padding: 1px;">
    <img src="https://srec.ac.in/uploads/resource/src/8yeEAIUofd01022018043456srec-logo.jpg" alt="SNR_trust_logo"
        style="width:150px;height:150px; text-align:center;font-size: 5rem; float: right; margin: 18px; max-width: 100%; max-height: 100%; padding: 1px;">

    <div class="container-fluid" style="background-color:rgb(125, 40, 159)">
        <font color="white" style="font-family:Verdana;font-style:cursive;">
            <h2
                style="text-align: center; padding: 0px ;font-size:50px;background-color:purple;color:transparent;-webkit-text-stroke:1px #fff;background:url(assets/SREC_and_SNR_logo_header_back.png);clip:text;background-position:0 0;animation:back 20s linear infinite;">
                <b>
                    <style>
                        @keyframes back {
                            100% {
                                background-position: 2000px 0;
                            }
                        }
                    </style>
                    <h1 style="font-size:40px" class="flicker">SRI RAMAKRISHNA ENGINEERING COLLEGE</h1>
                    <h4>[Educational Service: SNR Sons Charitable Trust]<br>
                        [Autonomous Institution, Reaccredited by NAAC with ‘A+’ Grade]<br>
                        [Approved by AICTE and Permanently Affiliated to Anna University, Chennai]<br>
                        [ ISO 9001:2015 Certified and all eligible programmes Accredited by NBA]<br>
                        VATTAMALAIPALAYAM, N.G.G.O. COLONY POST, COIMBATORE – 641 022.</h4>
                    <h5>Developed by<br>AI&DS and IQAC</h5>
        </font>
    </div>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .footer {
            position: relative;
            left: 0;
            bottom: 0;
            width: 100%;
            color: white;
            text-align: center;
        }

        .img1 {
            margin: 4px 4px;
        }

        br body {
            font-family: Verdana;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        br div {
            width: 100%;
            max-width: 1000px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        table,
        th,
        td {
            border: 10px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            width: 10%;
            text-align: left;
        }

        th {
            width: 10%;
            background-color: #f2f2f2;
        }

        .input-section {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            box-sizing: border-box;
        }

        .input-section label {
            width: calc(32% - 28px);
            margin-bottom: 5px;
            box-sizing: border-box;
            display: block;
            font-weight: bold;
        }

        .input-section input {
            width: calc(32% - 28px);
            margin-bottom: 15px;
            box-sizing: border-box;
            padding: 10px;
        }

        .input-section input[type="button"] {
            width: 100%;
            padding: 10px;
            align-self: center;
        }

        .display-section {
            margin-top: 20px;
            overflow-x: auto;
        }

        .input-section input {
            width: calc(45% - 28px);
            margin-bottom: 15px;
            box-sizing: border-box;
            padding: 10px;
        }
    </style>
    <div class="custom-dropdown">
        <div style="width: 640px;">
            <label for="NameoftheMentor">Department: <?php echo $_SESSION['department']; ?></label>
            <input type="hidden" id="department" placeholder="Department" value="<?php echo $_SESSION['department']; ?>">
        </div>
    </div>
        <!-- <div class="custom-dropdown">
            <div style="width: 300px;;">
                <label for="Department">Department:</label>
                <select id="Department" onchange="adjustOptionWidth(this)">
                    <option value="select">Select</option>
                    <option value="Department of Artificial Intelligence and Data Science">Department of
                        Artificial
                        Intelligence and Data Science</option>
                    <option value="Department of Aeronautical Engineering ">Department of Aeronautical Engineering
                    </option>
                    <option value="Department of Biomedical Engineering">Department of Biomedical Engineering </option>
                    <option value="Department of Computer Science Engineering">Department of Computer Science
                        Engineering </option>
                    <option value="Department of Civil Engineering">Department of Civil Engineering </option>
                    <option value="Department of Electrical & Communication Engineering">Department of Electrical &
                        Communication Engineering </option>
                    <option value="Department of Electrical & Electronics Engineering">Department of Electrical &
                        Electronics Engineering </option>
                    <option value="Department of Electrical & Instrumentation Engineering">Department of Electrical &
                        Instrumentation Engineering </option>
                    <option value="Department of Information Technology">Department of Information Technology </option>
                    <option value="Department of Mechnical Engineering">Department of Mechnical Engineering </option>
                    <option value="Department of Robotics & Automation">Department of Robotics & Automation </option>
                    <option value="Department of Nano Science and Technology">Department of Nano Science and Technology
                    </option>
                    <option value="Program-M.Tech Computer Science Engineering">Program-M.Tech Computer Science
                        Engineering </option>
                    <option value="Master of Business Administration(MBA)">Master of Business Administration (MBA)
                    </option>
                </select>
            </div>
        </div> -->
        <style>
            .custom-dropdown {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .custom-dropdown select {
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                width: 90%;
                padding: 8px;
                border: 2px solid #ccc;
                border-radius: 1px;
                cursor: pointer;
            }

            .custom-dropdown::after {
                position: absolute;
                top: 70%;
                right: 650px;
                transform: translateY(-50%);
                pointer-events: none;
            }
        </style>

        <script>
            function adjustOptionWidth(selectElement) {
                var selectedIndex = selectElement.selectedIndex;
                if (selectedIndex !== -1) {
                    selectElement.options[selectedIndex].style.width = 'auto';
                }
            }
        </script>
        <style>
            table,
            th,
            td {
                border: 10px solid #ddd;
            }

            th,
            td {
                padding: 10px;
                width: 10%;
                text-align: center;
            }

            th {
                width: 10%;
                background-color: #f2f2f2;
            }
        </style>


        <h3 style="text-align:center;">Mentor Mentee System - Student Track Record(STR)</h3>
        <div class="input-section" style="display: flex; justify-content: center; margin-left: 10px;">
            <div style="width: calc(34%);">
                <label for="NameoftheMentor">Name of the Mentor: <?php echo $_SESSION['name']; ?></label>
                <input type="hidden" id="NameoftheMentor" placeholder="Name of the Mentor" value="<?php echo $_SESSION['name']; ?>">
            </div>
            <div style="width: calc(34%);">
                <label for="Class">Class:</label>
                <input type="text" id="Class" placeholder="Class">
            </div>
            <div style="width: calc(30%);">
                <label for="Batch">Batch:</label>
                <select id="Batch" style="width: 50%; padding: 13px;">
                    <option value="select">Select</option>
                    <option value="2020-2024">2020-2024</option>
                    <option value="2021-2025">2021-2025</option>
                    <option value="2022-2026">2022-2026</option>
                    <option value="2023-2027">2023-2027</option>
                    <option value="2024-2028">2024-2028</option>
                    <option value="2025-2029">2025-2029</option>
                    <option value="2026-2030">2026-2030</option>
                    <option value="2027-2031">2027-2031</option>
                    <option value="2028-2032">2028-2032</option>
                    <option value="2029-2033">2029-2033</option>
                </select>
            </div>
        </div>
        <div class="input-section" style="display: flex; justify-content: center; margin-left: -23px;">
            <div style="width: calc(34%);">
                <label for="designation">Mentor Designation:</label>
                <input type="text" id="designation" placeholder="Mentor Designation">
            </div>
            <div style="width: calc(30%);">
                <label for="semester" style="margin-left: -9px;">Semester:</label>
                <select id="Semester" style="width: 52%; padding: 13px; margin-left: -10px;">
                    <option value="select">Select</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
            </div>
            <div style="width: calc(30%);">
                <label for="academicYear" style="margin-left: 40px;">Academic Year:</label>
                <select id="academicYear" style="width: 49.5%; padding: 13px; margin-left: 39px;">
                    <option value="select">Select</option>
                    <option value="2023-2024">2023-2024</option>
                    <option value="2024-2025">2024-2025</option>
                    <option value="2025-2026">2025-2026</option>
                    <option value="2026-2027">2026-2027</option>
                    <option value="2027-2028">2027-2028</option>
                    <option value="2028-2029">2028-2029</option>
                    <option value="2029-2030">2029-2030</option>
                    <option value="2030-2031">2030-2031</option>
                    <option value="2031-2032">2031-2032</option>
                    <option value="2032-2033">2032-2033</option>
                </select>
            </div>

        </div>

        <div id="studentsTab" style="display: block;">
            <h3 style="text-align:center;">Student Details</h3>
            <table id="studentsTable">
                <tr>
                    <th>Roll Number/<br>Name</th>
                    <th>CGPA</th>
                    <th>No. of Arrear(s)</th>
                    <th>Paper<br>Presentation/<br>Technical event/Quiz</th>
                    <th>Project/<br>Hackathon</th>
                    <th>Extracurricular<br>Activities(Sports/Club/NSS/NCC/Others)</th>
                    <th>Online<br>Certifications<br>(Coursera/EDx/<br>NPTEL/Others)</th>
                    <th>Counseling</th>
                    <th>Signature of<br>Student<br>with Date</th>
                </tr>
            </table>
            <style>
                .input-section {
                    display: flex;
                    justify-content: space-between;
                    flex-wrap: wrap;
                }

                .input-section input,
                .input-section textarea {
                    width: calc(48% - 5px);
                    box-sizing: border-box;
                    margin-bottom: 10px;
                    padding: 12px;
                }

                #counseling {
                    width: calc(48% - 5px);
                    box-sizing: border-box;
                    margin-bottom: 10px;
                    padding: 12px;
                }

                #counseling::before {
                    content: attr(placeholder);
                    color: rgb(122, 115, 115);
                    position: absolute;
                    pointer-events: none;
                    user-select: none;
                    display: none;
                }

                #counseling:empty::before {
                    display: block;
                }
            </style>
            <script>
                function allowOnlyNumbers(input) {
                    input.value = input.value.replace(/\D/g, '');
                }
            </script>
            <div class="input-section">
                <input type="text" id="rollNumber" placeholder="RollNumber" oninput="allowOnlyNumbers(this)">
                <input type="text" id="studentName" placeholder="Name">
                <input type="text" id="cgpa" placeholder="CGPA">
                <input type="text" id="noofarrears" placeholder="No. of Arrear(s)">
                <input type="text" id="paperpresentationtechnicaleventquiz" oninput="formatInput(this)"
                    placeholder="Paper Presentation/Technical event/Quiz">
                <input type="text" id="projectorhackthaon" placeholder="Project/Hackathon">
                <input type="text" id="extracurricularactivites"
                    placeholder="Extracurricular Activities (Sports/Club/NSS/NCC/Others)">
                <input type="text" id="onlinecertification"
                    placeholder="Online Certification (Coursera/EDx/NPTEL/Others)">
                <div id="counseling" contenteditable="true"
                    style="border: 2px solid #ccc; padding: 8px; min-height: 10px; text-align: left;"
                    placeholder="Counseling (Press enter for bullet points)"></div>
                <input type="text" id="signatureofstudent" placeholder="Signature of Student">
                <input type="button" onclick="addStudent()" value="Add Student">
            </div>

            <script>
                function formatInput(input) {
                    let value = input.value.replace(/\D/g, '');
                    if (value.length > 1) {
                        value = value.slice(0, 1) + '/' + value.slice(1);
                    }
                    if (value.length > 3) {
                        value = value.slice(0, 3) + '/' + value.slice(3);
                    }
                    input.value = value;
                }
            </script>
            <script>
                document.getElementById('counseling').addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        var listItem = document.createElement('div');
                        listItem.innerHTML = '&bull;&nbsp;';
                        this.appendChild(listItem);
                        placeCaretAtEnd(listItem);
                    }
                });

                function placeCaretAtEnd(el) {
                    el.focus();
                    if (typeof window.getSelection != "undefined" && typeof document.createRange != "undefined") {
                        var range = document.createRange();
                        range.selectNodeContents(el);
                        range.collapse(false);
                        var sel = window.getSelection();
                        sel.removeAllRanges();
                        sel.addRange(range);
                    } else if (typeof document.body.createTextRange != "undefined") {
                        var textRange = document.body.createTextRange();
                        textRange.moveToElementText(el);
                        textRange.collapse(false);
                        textRange.select();
                    }
                }
            </script>
            </head>
            <style>
                .observation-section textarea {
                    width: 20%;
                    box-sizing: border-box;
                    padding: 8px;
                    margin-bottom: 10px;
                }
            </style>
            <div class="observation-section">
                <div>
                    <h3>Overall Observation(s) </h3>
                    <textarea id="overallObservations" placeholder="Enter overall observations"></textarea>
                </div>
                <div>
                    <h3>Action Taken</h3>
                    <textarea id="actionTaken" placeholder="Enter action taken"></textarea>
                </div>
            </div>

            <button onclick="exporttoPDF()"> Export to PDF </button>
            <a href="logout.php"><button> Logout </button></a>

            <script>
                function showTab(tabName) {
                    document.getElementById('studentsTab').style.display = (tabName === 'students') ? 'block' : 'none';
                }
                function showTab(tabName) {
                    var departmentSelect = document.getElementById('department');
                    // if (departmentSelect.value === 'select') {
                    //     alert('Please select a valid department.');
                    //     return;
                    // }
                    document.getElementById('studentsTab').style.display = (tabName === 'students') ? 'block' : 'none';
                }
                function addStudent() {
                    var rollNumber = document.getElementById('rollNumber').value;
                    var studentName = document.getElementById('studentName').value;
                    var cgpa = document.getElementById('cgpa').value;
                    var noofarrears = document.getElementById('noofarrears').value;
                    var paperpresentationtechnicaleventquiz = document.getElementById('paperpresentationtechnicaleventquiz').value;
                    var projectHackathon = document.getElementById('projectorhackthaon').value;
                    var extracurricularactivites = document.getElementById('extracurricularactivites').value;
                    var onlinecertification = document.getElementById('onlinecertification').value;
                    var counselingDiv = document.getElementById('counseling');
                    var counselingNodes = counselingDiv.childNodes;
                    var counselingContent = '';

                    for (var i = 0; i < counselingNodes.length; i++) {
                        if (counselingNodes[i].nodeName === 'DIV') {
                            counselingContent += '' + counselingNodes[i].innerText.trim() + '<br>';
                        } else if (counselingNodes[i].nodeName === 'BR') {
                            counselingContent += '<br>';
                        }
                    }

                    var counseling = counselingContent;

                    var signatureofstudent = document.getElementById('signatureofstudent').value;

                    var table = document.getElementById('studentsTable');
                    var row = table.insertRow(-1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    var cell6 = row.insertCell(5);
                    var cell7 = row.insertCell(6);
                    var cell8 = row.insertCell(7);
                    var cell9 = row.insertCell(8);

                    cell1.innerHTML = rollNumber + ' <br> ' + studentName;
                    cell2.innerHTML = cgpa;
                    cell3.innerHTML = noofarrears;
                    cell4.innerHTML = paperpresentationtechnicaleventquiz;
                    cell5.innerHTML = projectHackathon;
                    cell6.innerHTML = extracurricularactivites;
                    cell7.innerHTML = onlinecertification;
                    cell8.innerHTML = counseling;
                    cell9.innerHTML = signatureofstudent;


                    resetFields();
                }


                function resetFields() {
                    document.getElementById('rollNumber').value = '';
                    document.getElementById('studentName').value = '';
                    document.getElementById('cgpa').value = '';
                    document.getElementById('noofarrears').value = '';
                    document.getElementById('paperpresentationtechnicaleventquiz').value = '';
                    document.getElementById('projectorhackthaon').value = '';
                    document.getElementById('extracurricularactivites').value = '';
                    document.getElementById('onlinecertification').value = '';
                    document.getElementById('counseling').innerHTML = '';
                    document.getElementById('signatureofstudent').value = '';
                }

                function exporttoPDF() {
                    var department = document.getElementById('department').value;
                    if (department === 'select') {
                        alert('Please select a valid department before exporting.');
                        return;
                    }
                    var pdf = new jsPDF({ format: 'a4', orientation: 'landscape', unit: 'cm', lineHeight: 1 });
                    pdf.setFontSize(12);
                    var NameoftheMentor = document.getElementById('NameoftheMentor').value;
                    var designation = document.getElementById('designation').value;
                    const academicYear = document.getElementById('academicYear').value;
                    var Class = document.getElementById('Class').value;
                    const semester = document.getElementById('Semester').value;
                    const batch = document.getElementById('Batch').value;

                    if (!NameoftheMentor || !designation || !academicYear || !Class || !semester || !batch) {
                        alert("Please fill in all mentor details before adding student details.");
                        return;
                    }
                    const leftX = 3;
                    const rightX = 20;
                    const title = "Mentor Mentee System - Student Track Record(STR)";
                    const titleX = (pdf.internal.pageSize.width - pdf.getStringUnitWidth(title) * pdf.internal.getFontSize() / pdf.internal.scaleFactor) / 2;
                    pdf.text(title, titleX, 7);
                    const departmentTextWidth = pdf.getStringUnitWidth(department) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
                    const departmentX = (pdf.internal.pageSize.width - departmentTextWidth) / 2;

                    pdf.text(department, departmentX, 8);
                    pdf.text(`Name of the Mentor : ${NameoftheMentor}`, leftX, 9);
                    pdf.text(`Designation              : ${designation}`, leftX, 10);
                    pdf.text(`Academic Year        : ${academicYear}`, leftX, 11);
                    pdf.text(`Class       : ${Class}`, rightX, 9);
                    pdf.text(`Semester : ${semester}`, rightX, 10);
                    pdf.text(`Batch       : ${batch}`, rightX, 11);

                    var logoImg = new Image();
                    logoImg.src = 'https://i.postimg.cc/cHHdLfZn/Whats-App-Image-2024-01-24-at-7-50-24-PM.jpg';
                    const pdfWidth = pdf.internal.pageSize.width;
                    pdf.addImage(logoImg, 'JPEG', 1, 1, pdfWidth - 2, 5);

                    // v1 alignment issue
                    // pdf.autoTable({
                    //     html: '#studentsTable',
                    //     theme: 'plain',
                    //     startY: 12,
                    //     startX: 1,
                    //     styles: {
                    //         lineWidth: 0.1,
                    //         valign: 'middle',
                    //         halign: 'center',
                    //     },
                    //     columnStyles: {
                    //         0: { cellWidth: 3 },
                    //         1: { cellWidth: 2 },
                    //         2: { cellWidth: 2 },
                    //         3: { cellWidth: 3 },
                    //         4: { cellWidth: 2 },
                    //         5: { cellWidth: 3 },
                    //         6: { cellWidth: 3 },
                    //         7: { cellWidth: 6, halign: 'left' },
                    //         8: { cellWidth: 2 },
                    //     },

                    // });

                    // pdf.autoTable({
                    //     html: '#studentsTable',
                    //     theme: 'grid',
                    //     startY: 12,
                    //     endY: 19,
                    //     startX: 1,
                    //     styles: {
                    //         lineWidth: 0.1,
                    //         valign: 'middle',
                    //         halign: 'center',
                    //         overflow: 'linebreak',
                    //     },
                    //     columnStyles: {
                    //         0: { cellWidth: 3 },
                    //         1: { cellWidth: 2 },
                    //         2: { cellWidth: 2 },
                    //         3: { cellWidth: 3 },
                    //         4: { cellWidth: 2 },
                    //         5: { cellWidth: 3 },
                    //         6: { cellWidth: 3 },
                    //         7: { cellWidth: 6, halign: 'left' }, // Default alignment for 7th column
                    //         8: { cellWidth: 2 },
                    //     },
                    //     didParseCell: function (data) {
                    //         if (data.row.index === 0 && data.column.index === 7) {
                    //             data.cell.styles.halign = 'center'; // Override alignment for 7th column in the first row
                    //         }
                    //     },
                    //     didDrawPage: function (data) {

                    //     }
                    // });

                    // Initialize tableData2 with an empty array
                    const tableData2 = [];

                    // Get the table reference
                    const table = document.getElementById('studentsTable');

                    // Get the first row (headers) and iterate through each cell
                    const headersRow = table.rows[0];
                    const headers = [];
                    for (let i = 0; i < headersRow.cells.length; i++) {
                        headers.push(headersRow.cells[i].innerText.trim());
                    }
                    // tableData2.push(headers);
                    tableData2.push(headers);

                    // Iterate through each row starting from the second row (data rows)
                    for (let i = 1; i < table.rows.length; i++) {
                        const rowData = [];
                        const dataRow = table.rows[i];
                        // Iterate through each cell in the row
                        for (let j = 0; j < dataRow.cells.length; j++) {
                            rowData.push(dataRow.cells[j].innerText.trim());
                        }
                        tableData2.push(rowData);
                    }

                    pdf.autoTable({
                        // head: [headers], // Optional table header
                        body: tableData2,
                        // rowPageBreak: 'auto', // Automatically split rows if needed
                        margin: { top: 2, right: 2, bottom: 4, left: 2 }, // Set margins (in centimeters)
                        startY: 12,
                        theme: 'plain',
                        styles: {
                            lineWidth: 0.1,
                            valign: 'middle',
                            halign: 'center',
                            // overflow: 'linebreak',
                        },
                        columnStyles: {
                            0: { cellWidth: 3 },
                            1: { cellWidth: 2 },
                            2: { cellWidth: 2 },
                            3: { cellWidth: 3 },
                            4: { cellWidth: 2 },
                            5: { cellWidth: 3 },
                            6: { cellWidth: 3 },
                            7: { cellWidth: 6, halign: 'left' }, // Default alignment for 7th column
                            8: { cellWidth: 2 },
                        },
                        didParseCell: function (data) {
                            if (data.row.index === 0 && data.column.index === 7) {
                                data.cell.styles.halign = 'center'; // Override alignment for 7th column in the first row
                                data.cell.styles.valign = 'middle';
                            }
                        },
                        didDrawCell: function (data) {

                            // Check if the content of the cell exceeds the current page height
                            // var cellHeight = data.cell.height / pdf.internal.scaleFactor;
                            var cellHeight = data.cell.height;
                            var remainingHeight = pdf.internal.pageSize.height - 2 - data.cursor.y;


                            console.log("cellHeight: " + data.cell.height + ", Rem H: " + remainingHeight);
                            if (cellHeight > (remainingHeight)) {
                                // Calculate the position to draw the bottom border
                                var x1 = data.cell.x;
                                var x2 = data.cell.x + data.cell.width;
                                var oldY = data.cursor.y;
                                var y = oldY + remainingHeight;
                                console.log("in");
                                console.log("intHeight: " + pdf.internal.pageSize.height);

                                // Draw a border at the bottom of the cell
                                // pdf.setDrawColor(0); // Set border color to black
                                pdf.setLineWidth(0.1); // Set border line width

                                // Save the current line width
                                var originalLineWidth = 0.1;

                                // Draw bottom border with reduced height
                                // pdf.line(x1, y, x2, y);

                                // Restore the original line width
                                pdf.setLineWidth(originalLineWidth);

                                // Prevent drawing the border lines inside the cell
                                // data.cell.styles.lineWidth = 0;
                                if (data.cursor.y > y) {

                                    data.cursor.y = oldY;
                                }

                                if (data.column.index === 8) {
                                    // Move to a new page
                                    // pdf.addPage();
                                }

                                // Reset cursor position to the top of the new page

                            }
                        },
                    });

                    pdf.addPage();
                    pdf.text('Overall Observation(s)', 1, 2);
                    var overallObservationLines = pdf.splitTextToSize(document.getElementById('overallObservations').value, pdf.internal.pageSize.width - 2);
                    for (var i = 0; i < overallObservationLines.length; i++) {
                        pdf.text(overallObservationLines[i], 1, 3 + i);
                    }
                    pdf.text('Action Taken', 1, 10);
                    var actionTakenLines = pdf.splitTextToSize(document.getElementById('actionTaken').value, pdf.internal.pageSize.width - 2);
                    for (var i = 0; i < actionTakenLines.length; i++) {
                        pdf.text(actionTakenLines[i], 1, 11 + i);
                    }
                    pdf.text('Signature of the Mentor with Date', 1, 19);
                    pdf.text('Academic Coordinator', 12, 19);
                    pdf.text('Head of the Department', 23, 19);
                    pdf.save('Studentdetails.pdf');
                }

            </script>

</body>

</html>