import {TAbstractObject} from './TAbstractObject';
import {TItemProto} from './TItemProto';

type TItemProtos = {
    [type:string]: TItemProto;
}

export interface TObjectsArray extends TAbstractObject {
    item_proto:TItemProtos;
    items:TAbstractObject[];
}