<?php include('partials-front/menu.php');?>

<style>
    /* Style inputs with type="text", select elements and textareas */
input[type=text], select, textarea {
  width: 100%; /* Full width */
  padding: 12px; /* Some padding */ 
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
input[type=submit]:hover {
  background-color: #45a049;
}

/* Add a background color and some padding around the form */
.contactcontainer {
  border-radius: 5px;
  background-color: #E3EAE3;
  padding: 20px;
}
</style>
 <!-- CAtegories Section Starts Here -->

 <section class="categories">
        <div class="container">
            <h2 class="text-center">Openingstijden</h2>
            
        </div>
        <div class="container">
            <h2 class="text-center">Adres</h2>
        </div>
        <div class="container">
            <h2 class="text-center">Contact Us</h2>
            <div class="contactcontainer">
            <form action="action_page.php">

            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Your name..">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Your last name..">

            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

            <input type="submit" value="Submit">

            </form>
            </div>
            
        </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
<?php include('partials-front/footer.php');?>
