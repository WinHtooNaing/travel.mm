<?php 
include 'header.php';


   $stmt = $pdo->prepare("SELECT * FROM users WHERE role = 1");
   $stmt -> execute();
   $result = $stmt->fetchAll();

?>
<div class="container">
   <div class="row">
      <h1 class="text-center mt-50 mb-100">About Me</h1>
      <div class="col-lg-12">
         <div class="row">
            <div class="col-lg-6">
               <div class="image" >
                  <img src="admin/assets/images/user_image/<?php echo $result[0]['image'] ?>" alt="" style="width: 80%;height:300px;object-fit:cover;margin-left:10%;border-radius: 20px;">
               </div>
            </div>
            <div class="col-lg-6">
               <div class="about" style="width: 90%;margin-left:5%">
                  <p style="line-height:30px">      အားလုံးပဲ မဂ်လာပါခင်ဗျ ။ ကျွန်တော့်နာမည်ကတော့ <?php echo $result[0]['username'] ?> ဖြစ်ပါတယ်ဗျ။ 
                  ကျွန်တော်က ဒီ travel.mm page ကို ဖန်တီးထားတယ့် သူဖြစ်ပါတယ်။ ဒီ page ရဲ့ admin အဖြစ်လည်း လုပ်ဆောင်နေပါတယ် ခင်ဗျ။
                   ယခု အချိန်မှာ ကျွန်တော်က University of Computer Studies (Taungoo) မှာ တက်ရောက်နေတယ့် third year ကျောင်းသား တစ်ယောက် ဖြစ်ပါတယ်ဗျ။
                  ကျွန်တော့်ရဲ့ ရည်မှန်းချက်ကတော့ full stack web developer တစ်ယောက် ဖြစ်ချင်တာပါ။ ကျွန်တော့်ရဲ့ github account ကို follow လုပ်ပေးခဲ့ပါအုံးဗျ။
                  github link ==> <a href="https://github.com/WinHtooNaing">winhtoonaing.github.io</a>
               </p>
               <div style="display: flex;margin-top:20px;float:right">
                  <img src="admin/assets/images/user_image/<?php echo $result[0]['image'] ?>" alt="" style="width:40px;height:40px;border-radius:50%;object-fit:cover;margin-right:10px">
                  <p style="padding-top:5px"><?php echo $result[0]['email'] ?></p>
               </div>
               </div>
            </div>
           
         </div>
      </div>
   </div>
</div><br><br>

<?php 
include 'footer.php'
?>