'use strict';
let url_exhibitors = "/index.php?option=com_projects&task=api.getExhibitors&api_key=4n98tpw49vtpw496npyww9p6by";

let Company = {
    searchByName: function (title) {
        jQuery.getJSON(`${url_exhibitors}&q=${title}`, function (json) {
            UI.Fields.par.elem.empty();
            jQuery.each(json, function (idx, obj) {
                UI.Fields.par.elem.append(`<option value="${obj.id}">${obj.exhibitor} (${obj.city})</option>`);
                UI.Fields.unlock(UI.Fields.par);
                UI.Fields.par.inp.value = title;
            })
        })
    },
    load: function () {
        let id = document.querySelector("#jform_hidden_parent_id").value;
        let value = document.querySelector("#jform_hidden_parent_title").value;
        if (id !== '' && value !== '') {
            UI.Fields.par.elem.append(`<option value="${id}">${value}</option>`);
            UI.Fields.unlock(UI.Fields.par);
        }
    },
};

let UI = {
    Fields: {
        par: {
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
    UI.Fields.par.elem = jQuery("#jform_parentID");
    UI.Fields.par.chzn = document.querySelector("#jform_parentID_chzn");
    UI.Fields.par.inp = document.querySelector("#jform_parentID_chzn .chzn-drop .chzn-search input");
    UI.Fields.unlock(UI.Fields.par);
    Company.load();
    jQuery(UI.Fields.par.inp).autocomplete({source: function () {
            let val = UI.Fields.par.inp.value;
            if (val.length < 3) return;
            Company.searchByName(val);
        }
    });
};
