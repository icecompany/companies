'use strict';
let url_exhibitors = "/index.php?option=com_projects&task=api.getExhibitors&api_key=4n98tpw49vtpw496npyww9p6by";
let url_cities = "/index.php?option=com_projects&task=api.getCities&api_key=4n98tpw49vtpw496npyww9p6by";

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
            UI.Fields.par.elem.append(`<option value="${id}" selected>${value}</option>`);
            UI.Fields.unlock(UI.Fields.par);
        }
    },
};

let Legal_city = {
    searchByName: function (title) {
        jQuery.getJSON(`${url_cities}&q=${title}`, function (json) {
            UI.Fields.legal_city.elem.empty();
            jQuery.each(json, function (idx, obj) {
                UI.Fields.legal_city.elem.append(`<option value="${obj.id}">${obj.name} (${obj.region})</option>`);
                UI.Fields.unlock(UI.Fields.legal_city);
                UI.Fields.legal_city.inp.value = title;
            })
        })
    },
    load: function () {
        let id = document.querySelector("#jform_hidden_legal_city_id").value;
        let value = document.querySelector("#jform_hidden_legal_city_title").value;
        if (id !== '' && value !== '') {
            UI.Fields.legal_city.elem.append(`<option value="${id}">${value}</option>`);
            UI.Fields.unlock(UI.Fields.legal_city);
        }
    },
};

let Fact_city = {
    searchByName: function (title) {
        jQuery.getJSON(`${url_cities}&q=${title}`, function (json) {
            UI.Fields.fact_city.elem.empty();
            jQuery.each(json, function (idx, obj) {
                UI.Fields.fact_city.elem.append(`<option value="${obj.id}">${obj.name} (${obj.region})</option>`);
                UI.Fields.unlock(UI.Fields.fact_city);
                UI.Fields.fact_city.inp.value = title;
            })
        })
    },
    load: function () {
        let id = document.querySelector("#jform_hidden_fact_city_id").value;
        let value = document.querySelector("#jform_hidden_fact_city_title").value;
        if (id !== '' && value !== '') {
            UI.Fields.fact_city.elem.append(`<option value="${id}">${value}</option>`);
            UI.Fields.unlock(UI.Fields.fact_city);
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
        legal_city: {
            chzn: '',
            inp: '',
            elem: ''
        },
        fact_city: {
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
    Links: {
        copy_addr: '',
    },
    copy_addr: function () {
        document.querySelector("#jform_fact_index").value = document.querySelector("#jform_legal_index").value;
        document.querySelector("#jform_fact_street").value = document.querySelector("#jform_legal_street").value;
        document.querySelector("#jform_fact_house").value = document.querySelector("#jform_legal_house").value;
        UI.Fields.fact_city.elem.empty();
        UI.Fields.unlock(UI.Fields.fact_city);
        let legal = document.querySelector("#jform_legal_city");
        let id = legal.options[legal.selectedIndex].value;
        let city = legal.options[legal.selectedIndex].innerText;
        let fact = jQuery("#jform_fact_city");
        fact.append(`<option value="${id}" selected>${city}</option>`);
        fact.trigger("liszt:updated");
    }
};

window.onload = function () {
    UI.Fields.par.elem = jQuery("#jform_parentID");
    UI.Fields.par.chzn = document.querySelector("#jform_parentID_chzn");
    UI.Fields.par.inp = document.querySelector("#jform_parentID_chzn .chzn-drop .chzn-search input");
    UI.Fields.legal_city.elem = jQuery("#jform_legal_city");
    UI.Fields.legal_city.chzn = document.querySelector("#jform_legal_city_chzn");
    UI.Fields.legal_city.inp = document.querySelector("#jform_legal_city_chzn .chzn-drop .chzn-search input");
    UI.Fields.fact_city.elem = jQuery("#jform_fact_city");
    UI.Fields.fact_city.chzn = document.querySelector("#jform_fact_city_chzn");
    UI.Fields.fact_city.inp = document.querySelector("#jform_fact_city_chzn .chzn-drop .chzn-search input");
    UI.Links.copy_addr = document.querySelector("#copy_addr");
    UI.Links.copy_addr.addEventListener('click', UI.copy_addr);
    UI.Fields.unlock(UI.Fields.par);
    UI.Fields.unlock(UI.Fields.legal_city);
    UI.Fields.unlock(UI.Fields.fact_city);
    Company.load();
    Legal_city.load();
    Fact_city.load();
    jQuery(UI.Fields.par.inp).autocomplete({source: function () {
            let val = UI.Fields.par.inp.value;
            if (val.length < 3) return;
            Company.searchByName(val);
        }
    });
    jQuery(UI.Fields.legal_city.inp).autocomplete({source: function () {
            let val = UI.Fields.legal_city.inp.value;
            if (val.length < 3) return;
            Legal_city.searchByName(val);
        }
    });
    jQuery(UI.Fields.fact_city.inp).autocomplete({source: function () {
            let val = UI.Fields.fact_city.inp.value;
            if (val.length < 3) return;
            Fact_city.searchByName(val);
        }
    });

    //Сохранение активной вкладки на странице
    jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', jQuery(this).attr('href'));
    });
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        jQuery('[href="' + lastTab + '"]').tab('show');
    }

};
