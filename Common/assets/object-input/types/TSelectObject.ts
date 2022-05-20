import {TValueObject} from './TValueObject';

export type TSelectOption = {
    value:any;
    title:string;
}

export interface TSelectObject extends TValueObject {
    options:TSelectOption[];
}