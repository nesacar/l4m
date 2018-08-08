import moment from 'moment';
export const STATIC_FIELDS = {

    sifra_artikla: {
        type: 'text',
        value: '',
    },
    naziv: {
        type: 'text',
        value: '',
    },
    publikovanje: {
        type: 'select',
        value: 0,
        options: [
            {id: 1, title: 'Objavi'},
            {id: 0, title: 'Ne objavi'},
        ],
    },
    dan_objave: {
        type: 'date',
        value: moment().format('YYYY-MM-DD'),
    },
    vreme_objave: {
        type: 'time',
        value: moment().format('HH:00'),
    },
    kolicina: {
        type: 'text',
        value: '',
    },
    cena: {
        type: 'text',
        value: '',
    },
    popust: {
        type: 'text',
        value: '',
    },
    brands: {
        type: 'select',
        value: -1,
        options: [],
    },
    collections: {
        type: 'select',
        value: -1,
        options: [],
    },
    categories: {
        type: 'multiselect',
        value: [],
        options: [],
    },
    kratak_opis: {
        type: 'text',
        value: '',
    },
    opis: {
        type: 'text',
        value: '',
    },
    opis2: {
        type: 'text',
        value: '',
    },


};
