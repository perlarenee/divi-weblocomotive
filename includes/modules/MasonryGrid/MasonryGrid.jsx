// External Dependencies
import React, { Component ,Fragment} from 'react';

// Internal Dependencies
import './style.css';

class MasonryGrid extends Component {

  static slug = 'et_pb_diwe_masonry_grid';

  _setWrappers(){
    //modifying wrapper classes for layout purposes. this is greedy and messy and i don't like it, but since I don't see a better way to accomplish this yet. I'll come back to it. 
    const structure = this.props.structure;
    const children = this.props.content;
    const changedObj = children;
    let i = 0;
    while(i<children.length){
      let child = children[i];
      let childSize = structure === "on" && child.props.attrs.size !== undefined && child.props.attrs.size !== "" ? child.props.attrs.size : 'xy1';
      let childSizeMob = structure === "on" && child.props.attrs.size_mobile !== undefined && child.props.attrs.size_mobile !== "" ? child.props.attrs.size_mobile : 'xy1';
      let childSizeTab = structure === "on" && child.props.attrs.size_tablet !== undefined && child.props.attrs.size_tablet !== "" ? child.props.attrs.size_tablet : 'xy1';
      let fit = child.props.attrs.fit !== undefined && child.props.attrs.fit !== "" ? child.props.attrs.fit : "width";
      let positionWidth = child.props.attrs.position_width !== undefined && child.props.attrs.position_width !== "" ? child.props.attrs.position_width : "left";
      let positionHeight = child.props.attrs.position_height !== undefined && child.props.attrs.position_height !== "" ? child.props.attrs.position_height : "top";
      let position = (fit === "height" ? positionWidth : positionHeight);
      let address = child.props.address;
      let item = document.querySelector('.et_pb_diwe_masonry_grid_item[data-address="'+address+'"]');
      if(item && item !== undefined && !item.classList.contains('grid-item')){
        item.classList.add('grid-item',childSize,'mobile-'+childSizeMob, 'tablet-'+childSizeTab,'fit-'+fit,'pos-'+position,'csselem:'+address);
      }
      i++;
    }
    this.props.content = changedObj;
  };
  
  componentDidUpdate(){
    this._setWrappers();
  }

  render() {
   this._setWrappers();
    return (
      <Fragment>
        <h1 className="masonry-grid-heading">{this.props.heading}</h1>
        <div className="diwe-masonry"><div className={"grid-wrapper "+this.props.size+" "+this.props.size_tablet+" "+this.props.size_mobile}>{this.props.content}</div></div>
      </Fragment>
    );
  }
}

export default MasonryGrid;