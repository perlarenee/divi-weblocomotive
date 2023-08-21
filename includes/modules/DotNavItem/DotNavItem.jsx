// External Dependencies
import React, { Component ,Fragment} from 'react';

class DotNavItem extends Component {
  static slug = 'et_pb_diwe_dotnav_item';

  _renderContent(){
    const props = this.props;
    if(!props.content().props.content){
      return false;
    }
    return (
      <Fragment>
        {props.content()}
      </Fragment>
    )
  };

  render() {
    console.log(this);
    return (
      <Fragment>
          {this._renderContent()}
      </Fragment>
    )
  };

};
export default DotNavItem;