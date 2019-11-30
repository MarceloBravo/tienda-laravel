function selectAll()
{
    var inputs = document.querySelectorAll('input');
    for(i=0; i < inputs.length; i++)
    {
        if(inputs[i].type == 'checkbox')
        {
            inputs[i].checked = document.getElementById('chk-select-all').checked;            
        }
    }

}