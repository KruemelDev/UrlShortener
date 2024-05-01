document.getElementById()
function displayFormInput(){
    let inputField = document.getElementById("urlInput");
    let inputFieldValue = inputField.value;
    console.log(inputFieldValue);
    let targetUrlText = document.getElementById("displayTargetUrlText");
    if(inputFieldValue === ""){
        targetUrlText.style.visibility = "hidden";
        targetUrlText.innerHTML = "q";
    }
    else{
        targetUrlText.style.visibility = "visible";
        targetUrlText.innerHTML = inputFieldValue;
    }

}