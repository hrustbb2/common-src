import {EInputTypes} from '../types/EInputTypes';

export interface TAbstractObject {
    type:EInputTypes;
    composite:boolean;
    description:string;
    errors:string[];
    value?:any;
}