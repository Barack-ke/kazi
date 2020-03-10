<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <br>
        <div class="container" style="text-align: center;">
            
            <form method="post" action="<?=base_url('emailcontroller/sends')?>" enctype="multipart/form-data">
                <input type="email" id="to" name="to" placeholder="Receiver Email">
                <br><br>
                <input type="text" id="subject" name="subject" placeholder="Subject">
                <br><br>
                <textarea rows="6" id="message" name="message" placeholder="Type your message here"></textarea>
                <br><br>
                <input type="submit" value="Send Email" />
            </form>
        </div>
    </body>
</html>