
    var ShowUsersBtn = document.getElementById('ShowUsersBtn');
    var ShowcategoriesBtn = document.getElementById('ShowcategoriesBtn');
    var ShowProductsBtn = document.getElementById('ShowProductsBtn');

    var usersDiv = document.getElementById('usersDiv');
    var categoriesDiv = document.getElementById('categoriesDiv');
    var productsDiv = document.getElementById('productsDiv');

function ShowHideDiv(button,div1,div2,div3)
{
    button.onclick = function() {
    if (button === ShowUsersBtn) {
        div1.style.display = "block"; // Show the div
        div2.style.display = "none"// Hide the div
        div3.style.display = "none"// Hide the div
    } else
    if (button === ShowcategoriesBtn) {
        div2.style.display = "block"; // Show the div
        div1.style.display = "none"
        div3.style.display = "none"

    }
    else
    if (button === ShowProductsBtn) {
        div3.style.display = "block"; // Show the div
        div1.style.display = "none"
        div2.style.display = "none"

    }
};
}
