<?php require "admin-header.php"; 

?>

<style>

.chat-box{
    height: 450px;
    background: #f7f7f7;
    padding: 10px 30px 20px 30px;
    box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%), inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
    overflow-y: auto;
}
.chat-box .chat{
    margin: 15px 0;
}
.chat-box .chat p{
    word-break: break-word;
    padding: 8px 16px;
    box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%), inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
}
.chat-box .outgoing{
    display: flex;
}
.outgoing .details p{
    background: #333;
    color: #fff;
    border-radius: 18px 18px 0 18px;
}
.outgoing .details{
    margin-left: auto;
    max-width: calc(100% - 40px);
}
.chat-box .incoming img{
    height: 35px;
    width: 35px;
}
.chat-box .incoming{
    display: flex;

}
.incoming .details p{
    background:  green;
    color: #fff;
    border-radius: 18px 18px 18px 0;
}
.incoming .details{
    margin-left: 10px;
    margin-right: auto;
    max-width: calc(100% - 40px);
}
.chat-box::-webkit-scrollbar{
    width: 0px;
}
.chat-area .typing-area{
    padding: 18px 30px;
    display: flex;
    justify-content: space-between;
}
.typing-area textarea{
    height: 45px;
    width: calc(100% - 58px);
    font-size: 17px;
    border: 1px solid #ccc;
    padding: 0 13px;
    border-radius: 5px 0 05px;
    outline: none;
}
.typing-area button{
    width: 55px;
    border: none;
    outline: none;
    border-radius: 0 5px 5px 0;
    background: #333;
    color: #fff;
    font-size: 19px;
    cursor: pointer;
}

</style>


<section class="chat-area mt-5 pt-3">

<div class="row justify-content-center">
    <div class="col-lg-4">
    
    <div class="chat-box">

    <?php
    $error = [];

if(isset($_GET['student_id'])){

    $incoming_id =  $_GET['student_id'];
}

if(isset($_POST['chat_btn'])){

    $message = trim($_POST['message']);
    $message = htmlspecialchars($message);
    $message = stripslashes($message);

    $incoming_id = $_POST['incoming_id'];

    $outgoing_id =  $_POST['outgoing_id'];

    $sql = "INSERT INTO messages (incoming_id, outgoing_id, message) VALUES(?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $incoming_id, $outgoing_id, $message);
    if($stmt->execute()){
        $sql1 = "SELECT * FROM messages WHERE (outgoing_id = '$outgoing_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$outgoing_id')";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result = $stmt1->get_result();
if($result->num_rows > 0){
    while($fetch = $result->fetch_assoc()){
        if($fetch['outgoing_id'] === $outgoing_id){
            echo '
            <div class="chat outgoing">
    <div class="details">
        <p>'.$fetch['message'].'</p>
    </div>
</div>
            ';
        } else{
            echo '
            <div class="chat incoming">
    <div class="details">
        <p>'.$fetch['message'].'</p>
    </div>
</div>
            ';
        }
    }
}

}

} else {
    $outgoing_id = $_SESSION['admin'];
    
    $sql1 = "SELECT * FROM messages WHERE (outgoing_id = '$outgoing_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$outgoing_id')";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result = $stmt1->get_result();
if($result->num_rows > 0){
    $sql3 = "UPDATE messages SET alert = '1' WHERE incoming_id='$outgoing_id' AND outgoing_id='$incoming_id' AND alert != '1'";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();
while($fetch = $result->fetch_assoc()){
    if($fetch['outgoing_id'] === $outgoing_id){
        echo '
        <div class="chat outgoing">
<div class="details">
    <p>'.$fetch['message'].'</p>
</div>
</div>
        ';
    } else{
        echo '
        <div class="chat incoming">
<div class="details">
    <p>'.$fetch['message'].'</p>
</div>
</div>
        ';
    }
}
}
if($result->num_rows === 0){
    echo "<div class='text-center mt-5 pt-5 fw-bold'>No Message</div>";
}
}
?>


        
    </div>

   
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="typing-area">
        <div id="error"></div>
        <textarea placeholder="type something here..." name="message" class="form_data" class="input-field"></textarea>
        <input type="hidden" name="outgoing_id" class="form_data" value="<?= $row['unique_id']; ?>">
        <input type="hidden" name="incoming_id" id="form_data" value="<?= $incoming_id; ?>" />
        <button type="submit" class="btn" id="chat_btn" name="chat_btn"><i class="bi bi-send text-white"></i></button>
    </form>

         
    </div>
</div>
</section>


<?php require "chat-footer.php"; ?>