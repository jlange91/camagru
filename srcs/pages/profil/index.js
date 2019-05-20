const profil = document.querySelector("#profil");
var loadMenuElement = [
  loadPicturesProfil,
  loadSettingsProfil
];
var deleteMenuElement = [
  deletePicturesProfil,
  deleteSettingsProfil
];
var menuId = 0;

var loadMenuProfil = function() {
  let sections = document.querySelector("#profil-menu-wrapper").children;

  for (let i = 0; i < sections.length; i++) {
    sections[i].className = (i == menuId) ? "is-active" : "";
    (i == menuId) ? loadMenuElement[i]() : deleteMenuElement[i]();
  }
}

let sections = document.querySelector("#profil-menu-wrapper").children;

NodeList.prototype.forEach = Array.prototype.forEach;

for (let i = 0; i < sections.length; i++) {
  sections[i].onclick = function() {  menuId=i;loadMenuProfil(); };

}

loadMenuProfil();
