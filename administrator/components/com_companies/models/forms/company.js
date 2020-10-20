'use strict';
let url_exhibitors = "index.php?option=com_companies&task=companies.execute&format=json";
let url_cities = "index.php?option=com_companies&task=cities.execute&format=json";

let Company = {
    searchByName: function (title) {
        let id = getURLParam(location.search, 'id');
        jQuery.getJSON(`${url_exhibitors}&search=${title}&not=${id}`, function (json) {
            UI.Fields.par.elem.empty();
            jQuery.each(json.data, function (idx, obj) {
                UI.Fields.par.elem.append(`<option value="${obj.id}">${obj.title} (${obj.city})</option>`);
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
    searchDuplicate: function (title) {
        let id = document.querySelector("#jform_hidden_parent_id").value;
        if (id !== '') return true;
        jQuery.getJSON(`${url_exhibitors}&search=${title}`, function (json) {
            let tbl = document.querySelector("#search-result > tbody");
            jQuery(tbl).empty();
            jQuery.each(json.data, function (idx, obj) {
                let tr = document.createElement('tr');
                let td1 = document.createElement('td');
                let url = document.createElement('a');
                url.href = `index.php?option=com_companies&task=company.edit&id=${obj.id}`;
                url.target = "_blank";
                url.text = obj.title;
                url.style.color = 'red';
                td1.appendChild(url);
                let td2 = document.createElement('td');
                td2.innerText = obj.city;
                tr.appendChild(td1);
                tr.appendChild(td2);
                tbl.appendChild(tr);
            })
        })
    },
};

let Legal_city = {
    searchByName: function (title) {
        jQuery.getJSON(`${url_cities}&q=${title}`, function (json) {
            UI.Fields.legal_city.elem.empty();
            jQuery.each(json.data, function (idx, obj) {
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
            jQuery.each(json.data, function (idx, obj) {
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

let Main_office_city = {
    searchByName: function (title) {
        jQuery.getJSON(`${url_cities}&q=${title}`, function (json) {
            UI.Fields.main_office_city.elem.empty();
            jQuery.each(json.data, function (idx, obj) {
                UI.Fields.main_office_city.elem.append(`<option value="${obj.id}">${obj.name} (${obj.region})</option>`);
                UI.Fields.unlock(UI.Fields.main_office_city);
                UI.Fields.main_office_city.inp.value = title;
            })
        })
    },
    load: function () {
        if (document.querySelector("#jform_hidden_main_office_city_id") !== null && document.querySelector("#jform_hidden_main_office_city_title") !== null) {
            let id = document.querySelector("#jform_hidden_main_office_city_id").value;
            let value = document.querySelector("#jform_hidden_main_office_city_title").value;
            if (id !== '' && value !== '') {
                UI.Fields.main_office_city.elem.append(`<option value="${id}">${value}</option>`);
                UI.Fields.unlock(UI.Fields.main_office_city);
            }
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
        main_office_city: {
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
    UI.Fields.main_office_city.elem = jQuery("#jform_main_office_city");
    UI.Fields.main_office_city.chzn = document.querySelector("#jform_main_office_city_chzn");
    UI.Fields.main_office_city.inp = document.querySelector("#jform_main_office_city_chzn .chzn-drop .chzn-search input");
    UI.Links.copy_addr = document.querySelector("#copy_addr");
    UI.Links.copy_addr.addEventListener('click', UI.copy_addr);
    UI.Fields.unlock(UI.Fields.par);
    UI.Fields.unlock(UI.Fields.legal_city);
    UI.Fields.unlock(UI.Fields.fact_city);
    if (document.querySelector("#jform_main_office_city") !== null) UI.Fields.unlock(UI.Fields.main_office_city);
    Company.load();
    Legal_city.load();
    Fact_city.load();
    Main_office_city.load();
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
    jQuery(UI.Fields.main_office_city.inp).autocomplete({source: function () {
            let val = UI.Fields.main_office_city.inp.value;
            if (val.length < 3) return;
            Main_office_city.searchByName(val);
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

function getURLParam (oTarget, sVar) {
    return decodeURI(oTarget.replace(new RegExp("^(?:.*[&\\?]" + encodeURI(sVar).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}

Joomla.submitbutton = function (task) {
    let form = document.querySelector('#adminForm');
    let valid = document.formvalidator.isValid(form);
    if (task === 'company.cancel' || valid) {
        let fields = document.querySelectorAll("#adminForm input[type='text']");
        fields.forEach(function(elem) {
            elem.value = elem.value.trim();
            elem.value = elem.value.replace(/\s+/g, ' ');
        });
        Joomla.submitform(task, form);
    }
};