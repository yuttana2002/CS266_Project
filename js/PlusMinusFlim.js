var NumOfFlim = 0;

function PlusClick(){
    NumOfFlim ++;
    alert("test");
    alert( document.getElementById('NumOfFlim').value());
    document.getElementById('NumOfFlim').innerHTML = NumOfFlim;
    return true 
}
function MinusClick(){
    if(NumOfFlim > 0){
        NumOfFlim --;
        document.getElementById('NumOfFlim').innerHTML = NumOfFlim;
        return true  
    }

}