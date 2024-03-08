// Menu titik Hamburger
function showOptionsMenu(button) {
    var optionsMenu = button.nextElementSibling;
  
    optionsMenu.style.display = optionsMenu.style.display === 'none' ? 'block' : 'none';

    var allMenus = document.querySelectorAll('.options-menu');
    for (var i = 0; i < allMenus.length; i++) {
      if (allMenus[i] !== optionsMenu) {
        allMenus[i].style.display = 'none';
      }
    }
  }
  
  function editItem() {
    console.log('Edit clicked');
  }
  
  function deleteItem() {
    console.log('Delete clicked');
  }
  


