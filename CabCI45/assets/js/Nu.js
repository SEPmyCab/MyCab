/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#LoginRegisterDropdown .dropdown-menu').on({
    "click":function(e){
        e.stopPropagation();
    }
    
});
function showButtons (){
    if (isset($_SESSION['user'])) {
    if($_SESSION['user']!="")
    {
    $('#logout').show();
    $('#login-form,#register-form').hide();}}
}