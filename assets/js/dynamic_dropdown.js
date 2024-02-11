document.addEventListener('DOMContentLoaded', function () {
    const categorySelectElt = document.getElementById('category_feature_category');

    categorySelectElt.addEventListener('change', function (e) {
        const formEl = categorySelectElt.closest('form');

        fetch(formEl.action, {
            method: formEl.method,
            body: new FormData(formEl)
        })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newFeatureFormFieldEl = doc.getElementById('category_feature_name');

                newFeatureFormFieldEl.addEventListener('change', function (e) {
                    e.target.classList.remove('is-invalid');
                    const newForm = newFeatureFormFieldEl.closest('form');
                });

                document.getElementById('category_feature_name').replaceWith(newFeatureFormFieldEl);
            })
            .catch(function (err) {
                console.warn('Something went wrong.', err);
            });
    });
})
