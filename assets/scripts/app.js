const categories = document.getElementsByClassName('categorie');
const articles = document.getElementsByClassName('article');

for (let i = 0; i < categories.length; i++) {
  categories[i].addEventListener('click', () => {
    filter(categories[i].id);    
  });
}


const filter = (categorieId) => {
  if( (categorieId != 'all')) {

    for (let i = 0; i < articles.length; i++) {
          const category = articles[i].lastElementChild.textContent;
        if (category == categorieId) {
            articles[i].style.display = 'table-row';
        } else {
            articles[i].style.display = 'none';
        }
        
      }
    } else {
      console.log('all')
      for (let i = 0; i < articles.length; i++) {
        articles[i].style.display = 'table-row';
      }
    }

}
