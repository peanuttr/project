$(document).ready(function () {
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e) => {
      let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
      arrowParent.classList.toggle("showMenu");
    });
  }

  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
  });

  // $("#table").load("../assets/includes/load.php #userManage");
  // $("#dep").load("../assets/includes/load.php #getDep");
  // $("#delUser").load("../assets/includes/load.php #delUser", {'id':idDel});
  const href = window.location.href;
  const pathName = href.slice(30);
  // const idForEdit = pathName.slice(18, pathName.length);

  if (pathName == "/user-management.php") {
    $("#table").load("../assets/includes/load.php")
  }
  // else if (pathName == "/user-edit.php") {
  //   $("#dep").load("../assets/includes/getdep.php #findById")
  // }
  // else if (pathName == "/user-del.php") {
  //   $("#delUser").load("../assets/includes/load.php #deleteUser", { id: idForDelete ,hash: 'deleteUser' })
  //   window.location = "./user-management.php"
  // }
  // else if (pathName == "/user-add.php") {
  //   addUserForm(pathName);
  // }
  else if (pathName == "/user-add.php") {
    $("#dep").load("../assets/includes/getdep.php #findAll")
  }

  // function getAllUser(pathName) {
  //   $('#msg').append("<h1>การจัดการผู้ใช้</h1>");
  //   $("#table").load("../assets/includes/load.php", { 'pathname': pathName });
  // }

  // function getUserById(id, pathName) {
  //   $('#msg').append("<h1>แก้ไขข้อมูลผู้ใช้</h1>");
  //   $("#table").load("../assets/includes/load.php", { 'pathname': pathName, 'id': id });
  // }

  // function delUserById(id, pathName) {
  //   $("#table").load("../assets/includes/load.php", { 'pathname': pathName, 'id': id });
  // }

  // function addUserForm(pathName) {
  //   $("#msg").append('<h1>สร้างข้อมูลผู้ใช้งาน</h1>');
  //   $("#table").load("../assets/includes/load.php", { 'pathname': pathName });
  // }

  // function addUserForm(pathName) {
  //   $("#table").load("../assets/includes/load.php", { 'pathname': pathName });
  // }

}
)