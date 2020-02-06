'use strict';
let url_exhibitors = "/index.php?option=com_projects&task=api.getExhibitors&api_key=4n98tpw49vtpw496npyww9p6by";

let Company = {
    searchByName: function (title) {
        jQuery.getJSON(`${url_exhibitors}&q=${title}`, function (json) {
            UI.Fields.company.elem.empty();
            jQuery.each(json, function (idx, obj) {
                UI.Fields.company.elem.append(`<option value="${obj.id}">${obj.exhibitor} (${obj.city})</option>`);
                UI.Fields.unlock(UI.Fields.company);
                UI.Fields.company.inp.value = title;
            })
        })
    },
};

let UI = {
    Fields: {
        company: {
            chzn: '',
            inp: '',
            elem: ''
        },
        unlock: function (e) {
            e.elem.chosen({width: "95%"});
            e.elem.trigger("liszt:updated");
            e.chzn.classList.remove("chzn-container-single-nosearch");
            e.inp.removeAttribute('readonly');
        }
    },
};

window.onload = function () {
    UI.Fields.company.elem = jQuery("#jform_companyID");
    UI.Fields.company.chzn = document.querySelector("#jform_companyID_chzn");
    UI.Fields.company.inp = document.querySelector("#jform_companyID_chzn .chzn-drop .chzn-search input");
    UI.Fields.unlock(UI.Fields.company);
    jQuery(UI.Fields.company.inp).autocomplete({source: function () {
            let val = UI.Fields.company.inp.value;
            if (val.length < 3) return;
            Company.searchByName(val);
        }
    });
};

Joomla.submitbutton = function (task) {
    let form = document.querySelector('#adminForm');
    let valid = document.formvalidator.isValid(form);
    if (task === 'parent.cancel' || valid) {
        let fields = document.querySelectorAll("#adminForm input[type='text']");
        fields.forEach(function(elem) {
            elem.value = elem.value.trim();
            elem.value = elem.value.replace(/\s+/g, ' ');
        });
        Joomla.submitform(task, form);
    }
};