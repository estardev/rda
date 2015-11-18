
package it.isharedoc.schemas.instance;

import java.math.BigInteger;
import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.JAXBElement;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlElementRef;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlSchemaType;
import javax.xml.bind.annotation.XmlType;
import javax.xml.datatype.XMLGregorianCalendar;


/**
 * <p>Java class for anonymous complex type.
 * 
 * <p>The following schema fragment specifies the expected content contained within this class.
 * 
 * <pre>
 * &lt;complexType>
 *   &lt;complexContent>
 *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *       &lt;sequence>
 *         &lt;element name="results" type="{http://www.w3.org/2001/XMLSchema}integer"/>
 *         &lt;element name="items" minOccurs="0">
 *           &lt;complexType>
 *             &lt;complexContent>
 *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                 &lt;sequence>
 *                   &lt;element name="item" maxOccurs="unbounded" minOccurs="0">
 *                     &lt;complexType>
 *                       &lt;complexContent>
 *                         &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                           &lt;sequence>
 *                             &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;element name="created" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
 *                             &lt;element name="completed" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
 *                             &lt;element name="dueDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
 *                             &lt;element name="assignee" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                             &lt;element name="owner" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                             &lt;element name="priority" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
 *                             &lt;element name="instance" minOccurs="0">
 *                               &lt;complexType>
 *                                 &lt;complexContent>
 *                                   &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                                     &lt;sequence>
 *                                       &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}integer"/>
 *                                       &lt;element name="created" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
 *                                       &lt;element name="createdBy" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                                       &lt;element name="modified" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
 *                                       &lt;element name="modifiedBy" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                                       &lt;element name="appIdentifier" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                                       &lt;element name="appIdentifierDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
 *                                       &lt;element name="sbName" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                                       &lt;element name="status" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                                       &lt;element name="title" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                                       &lt;element name="subject" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                                     &lt;/sequence>
 *                                   &lt;/restriction>
 *                                 &lt;/complexContent>
 *                               &lt;/complexType>
 *                             &lt;/element>
 *                           &lt;/sequence>
 *                         &lt;/restriction>
 *                       &lt;/complexContent>
 *                     &lt;/complexType>
 *                   &lt;/element>
 *                 &lt;/sequence>
 *               &lt;/restriction>
 *             &lt;/complexContent>
 *           &lt;/complexType>
 *         &lt;/element>
 *       &lt;/sequence>
 *     &lt;/restriction>
 *   &lt;/complexContent>
 * &lt;/complexType>
 * </pre>
 * 
 * 
 */
@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "", propOrder = {
    "results",
    "items"
})
@XmlRootElement(name = "TaskSearchResponse")
public class TaskSearchResponse {

    @XmlElement(required = true)
    protected BigInteger results;
    @XmlElementRef(name = "items", type = JAXBElement.class, required = false)
    protected JAXBElement<TaskSearchResponse.Items> items;

    /**
     * Gets the value of the results property.
     * 
     * @return
     *     possible object is
     *     {@link BigInteger }
     *     
     */
    public BigInteger getResults() {
        return results;
    }

    /**
     * Sets the value of the results property.
     * 
     * @param value
     *     allowed object is
     *     {@link BigInteger }
     *     
     */
    public void setResults(BigInteger value) {
        this.results = value;
    }

    /**
     * Gets the value of the items property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link TaskSearchResponse.Items }{@code >}
     *     
     */
    public JAXBElement<TaskSearchResponse.Items> getItems() {
        return items;
    }

    /**
     * Sets the value of the items property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link TaskSearchResponse.Items }{@code >}
     *     
     */
    public void setItems(JAXBElement<TaskSearchResponse.Items> value) {
        this.items = value;
    }


    /**
     * <p>Java class for anonymous complex type.
     * 
     * <p>The following schema fragment specifies the expected content contained within this class.
     * 
     * <pre>
     * &lt;complexType>
     *   &lt;complexContent>
     *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *       &lt;sequence>
     *         &lt;element name="item" maxOccurs="unbounded" minOccurs="0">
     *           &lt;complexType>
     *             &lt;complexContent>
     *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *                 &lt;sequence>
     *                   &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;element name="created" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
     *                   &lt;element name="completed" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
     *                   &lt;element name="dueDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
     *                   &lt;element name="assignee" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                   &lt;element name="owner" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                   &lt;element name="priority" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
     *                   &lt;element name="instance" minOccurs="0">
     *                     &lt;complexType>
     *                       &lt;complexContent>
     *                         &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *                           &lt;sequence>
     *                             &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}integer"/>
     *                             &lt;element name="created" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
     *                             &lt;element name="createdBy" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                             &lt;element name="modified" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
     *                             &lt;element name="modifiedBy" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                             &lt;element name="appIdentifier" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                             &lt;element name="appIdentifierDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
     *                             &lt;element name="sbName" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                             &lt;element name="status" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                             &lt;element name="title" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                             &lt;element name="subject" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                           &lt;/sequence>
     *                         &lt;/restriction>
     *                       &lt;/complexContent>
     *                     &lt;/complexType>
     *                   &lt;/element>
     *                 &lt;/sequence>
     *               &lt;/restriction>
     *             &lt;/complexContent>
     *           &lt;/complexType>
     *         &lt;/element>
     *       &lt;/sequence>
     *     &lt;/restriction>
     *   &lt;/complexContent>
     * &lt;/complexType>
     * </pre>
     * 
     * 
     */
    @XmlAccessorType(XmlAccessType.FIELD)
    @XmlType(name = "", propOrder = {
        "item"
    })
    public static class Items {

        @XmlElement(nillable = true)
        protected List<TaskSearchResponse.Items.Item> item;

        /**
         * Gets the value of the item property.
         * 
         * <p>
         * This accessor method returns a reference to the live list,
         * not a snapshot. Therefore any modification you make to the
         * returned list will be present inside the JAXB object.
         * This is why there is not a <CODE>set</CODE> method for the item property.
         * 
         * <p>
         * For example, to add a new item, do as follows:
         * <pre>
         *    getItem().add(newItem);
         * </pre>
         * 
         * 
         * <p>
         * Objects of the following type(s) are allowed in the list
         * {@link TaskSearchResponse.Items.Item }
         * 
         * 
         */
        public List<TaskSearchResponse.Items.Item> getItem() {
            if (item == null) {
                item = new ArrayList<TaskSearchResponse.Items.Item>();
            }
            return this.item;
        }


        /**
         * <p>Java class for anonymous complex type.
         * 
         * <p>The following schema fragment specifies the expected content contained within this class.
         * 
         * <pre>
         * &lt;complexType>
         *   &lt;complexContent>
         *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
         *       &lt;sequence>
         *         &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;element name="created" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
         *         &lt;element name="completed" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
         *         &lt;element name="dueDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
         *         &lt;element name="assignee" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *         &lt;element name="owner" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *         &lt;element name="priority" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
         *         &lt;element name="instance" minOccurs="0">
         *           &lt;complexType>
         *             &lt;complexContent>
         *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
         *                 &lt;sequence>
         *                   &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}integer"/>
         *                   &lt;element name="created" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
         *                   &lt;element name="createdBy" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *                   &lt;element name="modified" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
         *                   &lt;element name="modifiedBy" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *                   &lt;element name="appIdentifier" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *                   &lt;element name="appIdentifierDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
         *                   &lt;element name="sbName" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *                   &lt;element name="status" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *                   &lt;element name="title" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *                   &lt;element name="subject" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *                 &lt;/sequence>
         *               &lt;/restriction>
         *             &lt;/complexContent>
         *           &lt;/complexType>
         *         &lt;/element>
         *       &lt;/sequence>
         *     &lt;/restriction>
         *   &lt;/complexContent>
         * &lt;/complexType>
         * </pre>
         * 
         * 
         */
        @XmlAccessorType(XmlAccessType.FIELD)
        @XmlType(name = "", propOrder = {
            "id",
            "created",
            "completed",
            "dueDate",
            "assignee",
            "owner",
            "priority",
            "instance"
        })
        public static class Item {

            @XmlElement(required = true)
            protected String id;
            @XmlElement(required = true)
            @XmlSchemaType(name = "dateTime")
            protected XMLGregorianCalendar created;
            @XmlElementRef(name = "completed", type = JAXBElement.class, required = false)
            protected JAXBElement<XMLGregorianCalendar> completed;
            @XmlElementRef(name = "dueDate", type = JAXBElement.class, required = false)
            protected JAXBElement<XMLGregorianCalendar> dueDate;
            @XmlElementRef(name = "assignee", type = JAXBElement.class, required = false)
            protected JAXBElement<String> assignee;
            @XmlElementRef(name = "owner", type = JAXBElement.class, required = false)
            protected JAXBElement<String> owner;
            @XmlElementRef(name = "priority", type = JAXBElement.class, required = false)
            protected JAXBElement<BigInteger> priority;
            protected TaskSearchResponse.Items.Item.Instance instance;

            /**
             * Gets the value of the id property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getId() {
                return id;
            }

            /**
             * Sets the value of the id property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setId(String value) {
                this.id = value;
            }

            /**
             * Gets the value of the created property.
             * 
             * @return
             *     possible object is
             *     {@link XMLGregorianCalendar }
             *     
             */
            public XMLGregorianCalendar getCreated() {
                return created;
            }

            /**
             * Sets the value of the created property.
             * 
             * @param value
             *     allowed object is
             *     {@link XMLGregorianCalendar }
             *     
             */
            public void setCreated(XMLGregorianCalendar value) {
                this.created = value;
            }

            /**
             * Gets the value of the completed property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
             *     
             */
            public JAXBElement<XMLGregorianCalendar> getCompleted() {
                return completed;
            }

            /**
             * Sets the value of the completed property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
             *     
             */
            public void setCompleted(JAXBElement<XMLGregorianCalendar> value) {
                this.completed = value;
            }

            /**
             * Gets the value of the dueDate property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
             *     
             */
            public JAXBElement<XMLGregorianCalendar> getDueDate() {
                return dueDate;
            }

            /**
             * Sets the value of the dueDate property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
             *     
             */
            public void setDueDate(JAXBElement<XMLGregorianCalendar> value) {
                this.dueDate = value;
            }

            /**
             * Gets the value of the assignee property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public JAXBElement<String> getAssignee() {
                return assignee;
            }

            /**
             * Sets the value of the assignee property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public void setAssignee(JAXBElement<String> value) {
                this.assignee = value;
            }

            /**
             * Gets the value of the owner property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public JAXBElement<String> getOwner() {
                return owner;
            }

            /**
             * Sets the value of the owner property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public void setOwner(JAXBElement<String> value) {
                this.owner = value;
            }

            /**
             * Gets the value of the priority property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link BigInteger }{@code >}
             *     
             */
            public JAXBElement<BigInteger> getPriority() {
                return priority;
            }

            /**
             * Sets the value of the priority property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link BigInteger }{@code >}
             *     
             */
            public void setPriority(JAXBElement<BigInteger> value) {
                this.priority = value;
            }

            /**
             * Gets the value of the instance property.
             * 
             * @return
             *     possible object is
             *     {@link TaskSearchResponse.Items.Item.Instance }
             *     
             */
            public TaskSearchResponse.Items.Item.Instance getInstance() {
                return instance;
            }

            /**
             * Sets the value of the instance property.
             * 
             * @param value
             *     allowed object is
             *     {@link TaskSearchResponse.Items.Item.Instance }
             *     
             */
            public void setInstance(TaskSearchResponse.Items.Item.Instance value) {
                this.instance = value;
            }


            /**
             * <p>Java class for anonymous complex type.
             * 
             * <p>The following schema fragment specifies the expected content contained within this class.
             * 
             * <pre>
             * &lt;complexType>
             *   &lt;complexContent>
             *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
             *       &lt;sequence>
             *         &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}integer"/>
             *         &lt;element name="created" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
             *         &lt;element name="createdBy" type="{http://www.w3.org/2001/XMLSchema}string"/>
             *         &lt;element name="modified" type="{http://www.w3.org/2001/XMLSchema}dateTime"/>
             *         &lt;element name="modifiedBy" type="{http://www.w3.org/2001/XMLSchema}string"/>
             *         &lt;element name="appIdentifier" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
             *         &lt;element name="appIdentifierDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
             *         &lt;element name="sbName" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
             *         &lt;element name="status" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
             *         &lt;element name="title" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
             *         &lt;element name="subject" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
             *       &lt;/sequence>
             *     &lt;/restriction>
             *   &lt;/complexContent>
             * &lt;/complexType>
             * </pre>
             * 
             * 
             */
            @XmlAccessorType(XmlAccessType.FIELD)
            @XmlType(name = "", propOrder = {
                "id",
                "created",
                "createdBy",
                "modified",
                "modifiedBy",
                "appIdentifier",
                "appIdentifierDate",
                "sbName",
                "status",
                "title",
                "subject"
            })
            public static class Instance {

                @XmlElement(required = true)
                protected BigInteger id;
                @XmlElement(required = true)
                @XmlSchemaType(name = "dateTime")
                protected XMLGregorianCalendar created;
                @XmlElement(required = true)
                protected String createdBy;
                @XmlElement(required = true)
                @XmlSchemaType(name = "dateTime")
                protected XMLGregorianCalendar modified;
                @XmlElement(required = true)
                protected String modifiedBy;
                @XmlElementRef(name = "appIdentifier", type = JAXBElement.class, required = false)
                protected JAXBElement<String> appIdentifier;
                @XmlElementRef(name = "appIdentifierDate", type = JAXBElement.class, required = false)
                protected JAXBElement<XMLGregorianCalendar> appIdentifierDate;
                @XmlElementRef(name = "sbName", type = JAXBElement.class, required = false)
                protected JAXBElement<String> sbName;
                @XmlElementRef(name = "status", type = JAXBElement.class, required = false)
                protected JAXBElement<String> status;
                @XmlElementRef(name = "title", type = JAXBElement.class, required = false)
                protected JAXBElement<String> title;
                @XmlElementRef(name = "subject", type = JAXBElement.class, required = false)
                protected JAXBElement<String> subject;

                /**
                 * Gets the value of the id property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link BigInteger }
                 *     
                 */
                public BigInteger getId() {
                    return id;
                }

                /**
                 * Sets the value of the id property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link BigInteger }
                 *     
                 */
                public void setId(BigInteger value) {
                    this.id = value;
                }

                /**
                 * Gets the value of the created property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link XMLGregorianCalendar }
                 *     
                 */
                public XMLGregorianCalendar getCreated() {
                    return created;
                }

                /**
                 * Sets the value of the created property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link XMLGregorianCalendar }
                 *     
                 */
                public void setCreated(XMLGregorianCalendar value) {
                    this.created = value;
                }

                /**
                 * Gets the value of the createdBy property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link String }
                 *     
                 */
                public String getCreatedBy() {
                    return createdBy;
                }

                /**
                 * Sets the value of the createdBy property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link String }
                 *     
                 */
                public void setCreatedBy(String value) {
                    this.createdBy = value;
                }

                /**
                 * Gets the value of the modified property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link XMLGregorianCalendar }
                 *     
                 */
                public XMLGregorianCalendar getModified() {
                    return modified;
                }

                /**
                 * Sets the value of the modified property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link XMLGregorianCalendar }
                 *     
                 */
                public void setModified(XMLGregorianCalendar value) {
                    this.modified = value;
                }

                /**
                 * Gets the value of the modifiedBy property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link String }
                 *     
                 */
                public String getModifiedBy() {
                    return modifiedBy;
                }

                /**
                 * Sets the value of the modifiedBy property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link String }
                 *     
                 */
                public void setModifiedBy(String value) {
                    this.modifiedBy = value;
                }

                /**
                 * Gets the value of the appIdentifier property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link JAXBElement }{@code <}{@link String }{@code >}
                 *     
                 */
                public JAXBElement<String> getAppIdentifier() {
                    return appIdentifier;
                }

                /**
                 * Sets the value of the appIdentifier property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link JAXBElement }{@code <}{@link String }{@code >}
                 *     
                 */
                public void setAppIdentifier(JAXBElement<String> value) {
                    this.appIdentifier = value;
                }

                /**
                 * Gets the value of the appIdentifierDate property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
                 *     
                 */
                public JAXBElement<XMLGregorianCalendar> getAppIdentifierDate() {
                    return appIdentifierDate;
                }

                /**
                 * Sets the value of the appIdentifierDate property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
                 *     
                 */
                public void setAppIdentifierDate(JAXBElement<XMLGregorianCalendar> value) {
                    this.appIdentifierDate = value;
                }

                /**
                 * Gets the value of the sbName property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link JAXBElement }{@code <}{@link String }{@code >}
                 *     
                 */
                public JAXBElement<String> getSbName() {
                    return sbName;
                }

                /**
                 * Sets the value of the sbName property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link JAXBElement }{@code <}{@link String }{@code >}
                 *     
                 */
                public void setSbName(JAXBElement<String> value) {
                    this.sbName = value;
                }

                /**
                 * Gets the value of the status property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link JAXBElement }{@code <}{@link String }{@code >}
                 *     
                 */
                public JAXBElement<String> getStatus() {
                    return status;
                }

                /**
                 * Sets the value of the status property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link JAXBElement }{@code <}{@link String }{@code >}
                 *     
                 */
                public void setStatus(JAXBElement<String> value) {
                    this.status = value;
                }

                /**
                 * Gets the value of the title property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link JAXBElement }{@code <}{@link String }{@code >}
                 *     
                 */
                public JAXBElement<String> getTitle() {
                    return title;
                }

                /**
                 * Sets the value of the title property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link JAXBElement }{@code <}{@link String }{@code >}
                 *     
                 */
                public void setTitle(JAXBElement<String> value) {
                    this.title = value;
                }

                /**
                 * Gets the value of the subject property.
                 * 
                 * @return
                 *     possible object is
                 *     {@link JAXBElement }{@code <}{@link String }{@code >}
                 *     
                 */
                public JAXBElement<String> getSubject() {
                    return subject;
                }

                /**
                 * Sets the value of the subject property.
                 * 
                 * @param value
                 *     allowed object is
                 *     {@link JAXBElement }{@code <}{@link String }{@code >}
                 *     
                 */
                public void setSubject(JAXBElement<String> value) {
                    this.subject = value;
                }

            }

        }

    }

}
