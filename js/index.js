document.addEventListener('DOMContentLoaded', function() {
    var sidebar = document.getElementById('linked');
    
    window.toggle = function() {
        if (sidebar.style.display === "none" || sidebar.style.display === "") {
            sidebar.style.display = "flex"; 
        } else {
            sidebar.style.display = "none"; 
        }
        console.log('Toggle clicked');
    };
});
