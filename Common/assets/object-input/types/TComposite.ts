import {TAbstractObject} from './TAbstractObject';
import {TCompositeFields} from './TCompositeFields';

export interface TComposite extends TAbstractObject {
    fields:TCompositeFields;
}