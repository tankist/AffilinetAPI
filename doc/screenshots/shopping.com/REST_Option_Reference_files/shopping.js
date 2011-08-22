/* IDs of XML Instance Representation boxes */
var xiBoxes = new Array('element_OfferSearchRequest_xibox', 'element_EchoRequest_xibox', 'element_EchoResponse_xibox', 'element_GeneralSearchRequest_xibox', 'element_GetSDCTimestampRequest_xibox', 'element_GetSDCTimestampResponse_xibox', 'element_SearchResponse_xibox', 'type_AbstractResponseType_xibox', 'type_ServerDetail_xibox', 'type_GeneralSearchRequestType_xibox', 'type_TrackingInfoType_xibox', 'type_ProductFilterType_xibox', 'type_NavigationFilterType_xibox', 'type_GeneralSearchSortType_xibox', 'type_GeneralSearchOptionsType_xibox', 'type_SearchResultType_xibox', 'type_TrackingElementType_xibox', 'type_ImageType_xibox', 'type_SearchHistoryType_xibox', 'type_CategorySelectionType_xibox', 'type_DynamicNavigationHistoryType_xibox', 'type_AttributeSelectionType_xibox', 'type_CategoryListType_xibox', 'type_CategoryType_xibox', 'type_ItemListType_xibox', 'type_ProductType_xibox', 'type_ImageListType_xibox', 'type_OfferListType_xibox', 'type_OfferType_xibox', 'type_ItemImageListType_xibox', 'type_ItemImageType_xibox', 'type_PriceType_xibox', 'type_StoreType_xibox', 'type_StoreLogoType_xibox', 'type_RatingInfoType_xibox', 'type_AttributeListType_xibox', 'type_AttributeType_xibox', 'type_AttributeValueListType_xibox', 'type_AttributeValueType_xibox', 'type_RelatedTermsType_xibox', 'type_OfferSearchRequestType_xibox', 'type_OfferSearchSortType_xibox', 'type_OfferSearchOptionsType_xibox', 'type_productSortEnumType_xibox', 'type_sortOrderEnumType_xibox', 'type_offerSortEnumType_xibox', 'type_itemSortEnumType_xibox', 'type_trackingElementTypeEnum_xibox', 'type_stockStatusEnumType_xibox', 'type_storePhoneNumberType_xibox', 'type_IdentityHeaderType_xibox', 'type_IndexInfoType_xibox', 'type_categoryContentEnumType_xibox', 'type_KeywordSearchType_xibox', 'type_CountryFlagType_xibox');
/* IDs of Schema Component Representation boxes */
var scBoxes = new Array('schema_scbox', 'element_OfferSearchRequest_scbox', 'element_EchoRequest_scbox', 'element_EchoResponse_scbox', 'element_GeneralSearchRequest_scbox', 'element_GetSDCTimestampRequest_scbox', 'element_GetSDCTimestampResponse_scbox', 'element_SearchResponse_scbox', 'type_AbstractResponseType_scbox', 'type_ServerDetail_scbox', 'type_GeneralSearchRequestType_scbox', 'type_TrackingInfoType_scbox', 'type_ProductFilterType_scbox', 'type_NavigationFilterType_scbox', 'type_GeneralSearchSortType_scbox', 'type_GeneralSearchOptionsType_scbox', 'type_SearchResultType_scbox', 'type_TrackingElementType_scbox', 'type_ImageType_scbox', 'type_SearchHistoryType_scbox', 'type_CategorySelectionType_scbox', 'type_DynamicNavigationHistoryType_scbox', 'type_AttributeSelectionType_scbox', 'type_CategoryListType_scbox', 'type_CategoryType_scbox', 'type_ItemListType_scbox', 'type_ProductType_scbox', 'type_ImageListType_scbox', 'type_OfferListType_scbox', 'type_OfferType_scbox', 'type_ItemImageListType_scbox', 'type_ItemImageType_scbox', 'type_PriceType_scbox', 'type_StoreType_scbox', 'type_StoreLogoType_scbox', 'type_RatingInfoType_scbox', 'type_AttributeListType_scbox', 'type_AttributeType_scbox', 'type_AttributeValueListType_scbox', 'type_AttributeValueType_scbox', 'type_RelatedTermsType_scbox', 'type_OfferSearchRequestType_scbox', 'type_OfferSearchSortType_scbox', 'type_OfferSearchOptionsType_scbox', 'type_productSortEnumType_scbox', 'type_sortOrderEnumType_scbox', 'type_offerSortEnumType_scbox', 'type_itemSortEnumType_scbox', 'type_trackingElementTypeEnum_scbox', 'type_stockStatusEnumType_scbox', 'type_storePhoneNumberType_scbox', 'type_IdentityHeaderType_scbox', 'type_IndexInfoType_scbox', 'type_categoryContentEnumType_scbox', 'type_KeywordSearchType_scbox', 'type_CountryFlagType_scbox');

/**
 * Can get the ID of the button controlling
 * a collapseable box by concatenating
 * this string onto the ID of the box itself.
 */
var B_SFIX = "_button";

/**
 * Counter of documentation windows
 * Used to give each window a unique name
 */
var windowCount = 0;

/**
 * Returns an element in the current HTML document.
 * 
 * @param elementID Identifier of HTML element
 * @return               HTML element object
 */
function getElementObject(elementID) {
    var elemObj = null;
    if (document.getElementById) {
        elemObj = document.getElementById(elementID);
    }
    return elemObj;
}             

/**
 * Closes a collapseable box.
 * 
 * @param boxObj       Collapseable box
 * @param buttonObj Button controlling box
 */
function closeBox(boxObj, buttonObj) {
  if (boxObj == null || buttonObj == null) {
     // Box or button not found
  } else {
     // Change 'display' CSS property of box
     boxObj.style.display="none";

     // Change text of button 
     if (boxObj.style.display=="none") {
        buttonObj.value=" + ";
     }
  }
}

/**
 * Opens a collapseable box.
 * 
 * @param boxObj       Collapseable box
 * @param buttonObj Button controlling box
 */
function openBox(boxObj, buttonObj) {
  if (boxObj == null || buttonObj == null) {
     // Box or button not found
  } else {
     // Change 'display' CSS property of box
     boxObj.style.display="block";

     // Change text of button
     if (boxObj.style.display=="block") {
        buttonObj.value=" - ";
     }
  }
}

/**
 * Sets the state of a collapseable box.
 * 
 * @param boxID Identifier of box
 * @param open If true, box is "opened",
 *             Otherwise, box is "closed".
 */
function setState(boxID, open) {
  var boxObj = getElementObject(boxID);
  var buttonObj = getElementObject(boxID+B_SFIX);
  if (boxObj == null || buttonObj == null) {
     // Box or button not found
  } else if (open) {
     openBox(boxObj, buttonObj);
     // Make button visible
     buttonObj.style.display="inline";
  } else {
     closeBox(boxObj, buttonObj);
     // Make button visible
     buttonObj.style.display="inline";
  }
}

/**
 * Switches the state of a collapseable box, e.g.
 * if it's opened, it'll be closed, and vice versa.
 * 
 * @param boxID Identifier of box
 */
function switchState(boxID) {
  var boxObj = getElementObject(boxID);
  var buttonObj = getElementObject(boxID+B_SFIX);
  if (boxObj == null || buttonObj == null) {
     // Box or button not found
  } else if (boxObj.style.display=="none") {
     // Box is closed, so open it
     openBox(boxObj, buttonObj);
  } else if (boxObj.style.display=="block") {
     // Box is opened, so close it
     closeBox(boxObj, buttonObj);
  }
}

/**
 * Closes all boxes in a given list.
 * 
 * @param boxList Array of box IDs
 */
function collapseAll(boxList) {
  var idx;
  for (idx = 0; idx < boxList.length; idx++) {
     var boxObj = getElementObject(boxList[idx]);
     var buttonObj = getElementObject(boxList[idx]+B_SFIX);
     closeBox(boxObj, buttonObj);
  }
}

/**
 * Open all boxes in a given list.
 * 
 * @param boxList Array of box IDs
 */
function expandAll(boxList) {
  var idx;
  for (idx = 0; idx < boxList.length; idx++) {
     var boxObj = getElementObject(boxList[idx]);
     var buttonObj = getElementObject(boxList[idx]+B_SFIX);
     openBox(boxObj, buttonObj);
  }
}

/**
 * Makes all the control buttons of boxes appear.
 * 
 * @param boxList Array of box IDs
 */
function viewControlButtons(boxList) {
    var idx;
    for (idx = 0; idx < boxList.length; idx++) {
        buttonObj = getElementObject(boxList[idx]+B_SFIX);
        if (buttonObj != null) {
            buttonObj.style.display = "inline";
        }
    }
}

/**
 * Makes all the control buttons of boxes disappear.
 * 
 * @param boxList Array of box IDs
 */
function hideControlButtons(boxList) {
    var idx;
    for (idx = 0; idx < boxList.length; idx++) {
        buttonObj = getElementObject(boxList[idx]+B_SFIX);
        if (buttonObj != null) {
            buttonObj.style.display = "none";
        }
    }
}

/**
 * Sets the page for either printing mode
 * or viewing mode. In printing mode, the page
 * is made to be more readable when printing it out.
 * In viewing mode, the page is more browsable.
 *
 * @param isPrinterVersion If true, display in
 *                                 printing mode; otherwise, 
 *                                 in viewing mode
 */
function displayMode(isPrinterVersion) {
    var obj;
    if (isPrinterVersion) {
        // Hide global control buttons
        obj = getElementObject("globalControls");
        if (obj != null) {
            obj.style.visibility = "hidden";
        }
        // Hide Legend
        obj = getElementObject("legend");
        if (obj != null) {
            obj.style.display = "none";
        }
        obj = getElementObject("legendTOC");
        if (obj != null) {
            obj.style.display = "none";
        }
        // Hide Glossary
        obj = getElementObject("glossary");
        if (obj != null) {
            obj.style.display = "none";
        }
        obj = getElementObject("glossaryTOC");
        if (obj != null) {
            obj.style.display = "none";
        }

        // Expand all XML Instance Representation tables
        expandAll(xiBoxes);
        // Expand all Schema Component Representation tables
        expandAll(scBoxes);

        // Hide Control buttons
        hideControlButtons(xiBoxes);
        hideControlButtons(scBoxes);
    } else {
        // View global control buttons
        obj = getElementObject("globalControls");
        if (obj != null) {
            obj.style.visibility = "visible";
        }
        // View Legend
        obj = getElementObject("legend");
        if (obj != null) {
            obj.style.display = "block";
        }
        obj = getElementObject("legendTOC");
        if (obj != null) {
            obj.style.display = "block";
        }
        // View Glossary
        obj = getElementObject("glossary");
        if (obj != null) {
            obj.style.display = "block";
        }
        obj = getElementObject("glossaryTOC");
        if (obj != null) {
            obj.style.display = "block";
        }

        // Expand all XML Instance Representation tables
        expandAll(xiBoxes);
        // Collapse all Schema Component Representation tables
        collapseAll(scBoxes);

        // View Control buttons
        viewControlButtons(xiBoxes);
        viewControlButtons(scBoxes);
    }
}

/**
 * Opens up a window displaying the documentation
 * of a schema component in the XML Instance
 * Representation table.
 * 
 * @param compDesc      Description of schema component 
 * @param compName      Name of schema component 
 * @param docTextArray Array containing the paragraphs 
 *                           of the new document
 */
function viewDocumentation(compDesc, compName, docTextArray) {
  var width = 400;
  var height = 200;
  var locX = 100;
  var locY = 200;

  /* Generate content */
  var actualText = "<html>";
  actualText += "<head><title>";
  actualText += compDesc;
  if (compName != '') {
     actualText += ": " + compName;
  }
  actualText += "</title></head>";
  actualText += "<body bgcolor=\"#FFFFEE\">";
  // Title
  actualText += "<p style=\"font-family: Arial, sans-serif; font-size: 12pt; font-weight: bold; letter-spacing:1px;\">";
  actualText += compDesc;
  if (compName != '') {
     actualText += ": <span style=\"color:#006699\">" + compName + "</span>";
  }
  actualText += "</p>";
  // Documentation
  var idx;
  for (idx = 0; idx < docTextArray.length; idx++) {
     actualText += "<p style=\"font-family: Arial, sans-serif; font-size: 10pt;\">" + docTextArray[idx] + "</p>";
  }
  // Link to close window
  actualText += "<a href=\"javascript:void(0)\" onclick=\"window.close();\" style=\"font-family: Arial, sans-serif; font-size: 8pt;\">Close</a>";
  actualText += "</body></html>";

  /* Display window */
  windowCount++;
  var docWindow = window.open("", "documentation"+windowCount, "toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable,alwaysRaised,dependent,titlebar=no,width="+width+",height="+height+",screenX="+locX+",left="+locX+",screenY="+locY+",top="+locY);
  docWindow.document.write(actualText);
}

/**
 * Toggles the API2 documentation.
 */
 
function toggleAPI2() {
    $$('.api2', '.notice').invoke('toggle');
}