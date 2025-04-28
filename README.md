# Website Usage Guide

## Setup Instructions

1. 😊Please copy the `MyProject` file into the `htdoc` directory to access and use our website.
2. The instructions for creating the database are in the `Setup_DBscript.txt` file located in `MyProject`.

---

## Screen and Program Development

### Internal Staff  
*(This part is implemented in the "Internal Staff" interface of our web navigation bar)*  

1. **Product Maintenance Program** (Add/Change product)  
2. **Customer Maintenance Program** (Add/Change Customer)  
3. **Review ALL Orders Information**  

### Public User (Customer)  
*(This part is implemented in the "Product" interface of our web navigation bar)*  

1. **Review Product Information**  
2. **Review Particular Product Details**  
   *(These are located at the bottom of the product page, above the shopping cart area)*  
3. **Enter Order Information**  
   *(This can be achieved during shopping cart checkout)*  

---

## Simulating User Operations for Making an Order

To simulate a user making an order, you can use the existing customer data (customer Email) in our database.  

### Order Processing Logic  

- **Read Customer Record** from the database to get the customer class and apply the corresponding discount:  

  | Customer Class      | Discount       |
  |---------------------|----------------|
  | Normal customer     | No discount    |
  | Silver customer     | 4% discount    |
  | Gold customer       | 6.5% discount  |

- **Calculate Order Amount**:  
  - Original amount = price × quantity  
  - Net amount = original amount × (1 – discount %)  

- **Update Records**:  
  - Add the order record to the database.  
  - Update the customer's accumulated bonus:  
    `accumulated bonus = accumulated bonus + net amount`  
  - Save the updated customer record.  

---

For further details, refer to the database setup instructions in `Setup_DBscript.txt`.  

# Division of this project
- Meng Siyu： Page design, front-end and back-end code, database establishment
- Wan Jiuyang: Technical support   