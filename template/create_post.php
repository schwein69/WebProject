<!--TODO check: a file or a text must be uploaded-->
<form action="" method="POST">
    <label for="testo">Testo:</label>
    <textarea id="testo" name="testo">
        Scrivi qui il testo:
    </textarea> <br>
    <label for="">Tags:</label>
    <input type="text" id="tag1" name="tag1"/> 
    <!--TODO generate with Javascript other tags--><br>
    <label for="tag1">Immagini:</label>
    <input type="file" id="f1" name="f1" accept="video/*,image/*"/> 
    <!--TODO generate with Javascript other input file--><br>
    <submit value="Crea post"/>
</form>