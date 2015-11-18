
package it.isharedoc.schemas.instance;

import java.math.BigDecimal;
import java.math.BigInteger;
import java.util.ArrayList;
import java.util.List;
import javax.activation.DataHandler;
import javax.xml.bind.JAXBElement;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlElementRef;
import javax.xml.bind.annotation.XmlMimeType;
import javax.xml.bind.annotation.XmlRootElement;
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
 *         &lt;element name="partitionId" type="{http://www.w3.org/2001/XMLSchema}integer"/>
 *         &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}integer"/>
 *         &lt;element name="subject" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="body" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="note" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="tags" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="extAppIdentifier" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="extAppIdentifierDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
 *         &lt;element name="variables" minOccurs="0">
 *           &lt;complexType>
 *             &lt;complexContent>
 *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                 &lt;sequence>
 *                   &lt;element name="variable" maxOccurs="unbounded" minOccurs="0">
 *                     &lt;complexType>
 *                       &lt;complexContent>
 *                         &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                           &lt;sequence>
 *                             &lt;element name="operation" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;element name="key" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;element name="type" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;choice>
 *                               &lt;element name="valueString" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                               &lt;element name="valueInteger" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
 *                               &lt;element name="valueDecimal" type="{http://www.w3.org/2001/XMLSchema}decimal" minOccurs="0"/>
 *                               &lt;element name="valueDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
 *                               &lt;element name="valueBoolean" type="{http://www.w3.org/2001/XMLSchema}boolean" minOccurs="0"/>
 *                             &lt;/choice>
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
 *         &lt;element name="attachments" minOccurs="0">
 *           &lt;complexType>
 *             &lt;complexContent>
 *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                 &lt;sequence>
 *                   &lt;element name="attachment" maxOccurs="unbounded" minOccurs="0">
 *                     &lt;complexType>
 *                       &lt;complexContent>
 *                         &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                           &lt;sequence>
 *                             &lt;element name="operation" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;element name="fileset" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;element name="filename" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;element name="contentType" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                             &lt;element name="data" type="{http://www.w3.org/2001/XMLSchema}base64Binary"/>
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
 *         &lt;element name="scheduledSendDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
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
    "partitionId",
    "id",
    "subject",
    "body",
    "note",
    "tags",
    "extAppIdentifier",
    "extAppIdentifierDate",
    "variables",
    "attachments",
    "scheduledSendDate"
})
@XmlRootElement(name = "InstanceMessageUpdateRequest")
public class InstanceMessageUpdateRequest {

    @XmlElement(required = true)
    protected BigInteger partitionId;
    @XmlElement(required = true)
    protected BigInteger id;
    @XmlElementRef(name = "subject", type = JAXBElement.class, required = false)
    protected JAXBElement<String> subject;
    @XmlElementRef(name = "body", type = JAXBElement.class, required = false)
    protected JAXBElement<String> body;
    @XmlElementRef(name = "note", type = JAXBElement.class, required = false)
    protected JAXBElement<String> note;
    @XmlElementRef(name = "tags", type = JAXBElement.class, required = false)
    protected JAXBElement<String> tags;
    @XmlElementRef(name = "extAppIdentifier", type = JAXBElement.class, required = false)
    protected JAXBElement<String> extAppIdentifier;
    @XmlElementRef(name = "extAppIdentifierDate", type = JAXBElement.class, required = false)
    protected JAXBElement<XMLGregorianCalendar> extAppIdentifierDate;
    @XmlElementRef(name = "variables", type = JAXBElement.class, required = false)
    protected JAXBElement<InstanceMessageUpdateRequest.Variables> variables;
    @XmlElementRef(name = "attachments", type = JAXBElement.class, required = false)
    protected JAXBElement<InstanceMessageUpdateRequest.Attachments> attachments;
    @XmlElementRef(name = "scheduledSendDate", type = JAXBElement.class, required = false)
    protected JAXBElement<XMLGregorianCalendar> scheduledSendDate;

    /**
     * Gets the value of the partitionId property.
     * 
     * @return
     *     possible object is
     *     {@link BigInteger }
     *     
     */
    public BigInteger getPartitionId() {
        return partitionId;
    }

    /**
     * Sets the value of the partitionId property.
     * 
     * @param value
     *     allowed object is
     *     {@link BigInteger }
     *     
     */
    public void setPartitionId(BigInteger value) {
        this.partitionId = value;
    }

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

    /**
     * Gets the value of the body property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getBody() {
        return body;
    }

    /**
     * Sets the value of the body property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setBody(JAXBElement<String> value) {
        this.body = value;
    }

    /**
     * Gets the value of the note property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getNote() {
        return note;
    }

    /**
     * Sets the value of the note property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setNote(JAXBElement<String> value) {
        this.note = value;
    }

    /**
     * Gets the value of the tags property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getTags() {
        return tags;
    }

    /**
     * Sets the value of the tags property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setTags(JAXBElement<String> value) {
        this.tags = value;
    }

    /**
     * Gets the value of the extAppIdentifier property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getExtAppIdentifier() {
        return extAppIdentifier;
    }

    /**
     * Sets the value of the extAppIdentifier property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setExtAppIdentifier(JAXBElement<String> value) {
        this.extAppIdentifier = value;
    }

    /**
     * Gets the value of the extAppIdentifierDate property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
     *     
     */
    public JAXBElement<XMLGregorianCalendar> getExtAppIdentifierDate() {
        return extAppIdentifierDate;
    }

    /**
     * Sets the value of the extAppIdentifierDate property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
     *     
     */
    public void setExtAppIdentifierDate(JAXBElement<XMLGregorianCalendar> value) {
        this.extAppIdentifierDate = value;
    }

    /**
     * Gets the value of the variables property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageUpdateRequest.Variables }{@code >}
     *     
     */
    public JAXBElement<InstanceMessageUpdateRequest.Variables> getVariables() {
        return variables;
    }

    /**
     * Sets the value of the variables property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageUpdateRequest.Variables }{@code >}
     *     
     */
    public void setVariables(JAXBElement<InstanceMessageUpdateRequest.Variables> value) {
        this.variables = value;
    }

    /**
     * Gets the value of the attachments property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageUpdateRequest.Attachments }{@code >}
     *     
     */
    public JAXBElement<InstanceMessageUpdateRequest.Attachments> getAttachments() {
        return attachments;
    }

    /**
     * Sets the value of the attachments property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageUpdateRequest.Attachments }{@code >}
     *     
     */
    public void setAttachments(JAXBElement<InstanceMessageUpdateRequest.Attachments> value) {
        this.attachments = value;
    }

    /**
     * Gets the value of the scheduledSendDate property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
     *     
     */
    public JAXBElement<XMLGregorianCalendar> getScheduledSendDate() {
        return scheduledSendDate;
    }

    /**
     * Sets the value of the scheduledSendDate property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
     *     
     */
    public void setScheduledSendDate(JAXBElement<XMLGregorianCalendar> value) {
        this.scheduledSendDate = value;
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
     *         &lt;element name="attachment" maxOccurs="unbounded" minOccurs="0">
     *           &lt;complexType>
     *             &lt;complexContent>
     *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *                 &lt;sequence>
     *                   &lt;element name="operation" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;element name="fileset" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;element name="filename" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;element name="contentType" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                   &lt;element name="data" type="{http://www.w3.org/2001/XMLSchema}base64Binary"/>
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
        "attachment"
    })
    public static class Attachments {

        @XmlElement(nillable = true)
        protected List<InstanceMessageUpdateRequest.Attachments.Attachment> attachment;

        /**
         * Gets the value of the attachment property.
         * 
         * <p>
         * This accessor method returns a reference to the live list,
         * not a snapshot. Therefore any modification you make to the
         * returned list will be present inside the JAXB object.
         * This is why there is not a <CODE>set</CODE> method for the attachment property.
         * 
         * <p>
         * For example, to add a new item, do as follows:
         * <pre>
         *    getAttachment().add(newItem);
         * </pre>
         * 
         * 
         * <p>
         * Objects of the following type(s) are allowed in the list
         * {@link InstanceMessageUpdateRequest.Attachments.Attachment }
         * 
         * 
         */
        public List<InstanceMessageUpdateRequest.Attachments.Attachment> getAttachment() {
            if (attachment == null) {
                attachment = new ArrayList<InstanceMessageUpdateRequest.Attachments.Attachment>();
            }
            return this.attachment;
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
         *         &lt;element name="operation" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;element name="fileset" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;element name="filename" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;element name="contentType" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *         &lt;element name="data" type="{http://www.w3.org/2001/XMLSchema}base64Binary"/>
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
            "operation",
            "fileset",
            "filename",
            "contentType",
            "data"
        })
        public static class Attachment {

            @XmlElement(required = true)
            protected String operation;
            @XmlElement(required = true)
            protected String fileset;
            @XmlElement(required = true)
            protected String filename;
            @XmlElementRef(name = "contentType", type = JAXBElement.class, required = false)
            protected JAXBElement<String> contentType;
            @XmlElement(required = true)
            @XmlMimeType("application/octet-stream")
            protected DataHandler data;

            /**
             * Gets the value of the operation property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getOperation() {
                return operation;
            }

            /**
             * Sets the value of the operation property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setOperation(String value) {
                this.operation = value;
            }

            /**
             * Gets the value of the fileset property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getFileset() {
                return fileset;
            }

            /**
             * Sets the value of the fileset property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setFileset(String value) {
                this.fileset = value;
            }

            /**
             * Gets the value of the filename property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getFilename() {
                return filename;
            }

            /**
             * Sets the value of the filename property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setFilename(String value) {
                this.filename = value;
            }

            /**
             * Gets the value of the contentType property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public JAXBElement<String> getContentType() {
                return contentType;
            }

            /**
             * Sets the value of the contentType property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public void setContentType(JAXBElement<String> value) {
                this.contentType = value;
            }

            /**
             * Gets the value of the data property.
             * 
             * @return
             *     possible object is
             *     {@link DataHandler }
             *     
             */
            public DataHandler getData() {
                return data;
            }

            /**
             * Sets the value of the data property.
             * 
             * @param value
             *     allowed object is
             *     {@link DataHandler }
             *     
             */
            public void setData(DataHandler value) {
                this.data = value;
            }

        }

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
     *         &lt;element name="variable" maxOccurs="unbounded" minOccurs="0">
     *           &lt;complexType>
     *             &lt;complexContent>
     *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *                 &lt;sequence>
     *                   &lt;element name="operation" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;element name="key" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;element name="type" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;choice>
     *                     &lt;element name="valueString" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                     &lt;element name="valueInteger" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
     *                     &lt;element name="valueDecimal" type="{http://www.w3.org/2001/XMLSchema}decimal" minOccurs="0"/>
     *                     &lt;element name="valueDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
     *                     &lt;element name="valueBoolean" type="{http://www.w3.org/2001/XMLSchema}boolean" minOccurs="0"/>
     *                   &lt;/choice>
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
        "variable"
    })
    public static class Variables {

        @XmlElement(nillable = true)
        protected List<InstanceMessageUpdateRequest.Variables.Variable> variable;

        /**
         * Gets the value of the variable property.
         * 
         * <p>
         * This accessor method returns a reference to the live list,
         * not a snapshot. Therefore any modification you make to the
         * returned list will be present inside the JAXB object.
         * This is why there is not a <CODE>set</CODE> method for the variable property.
         * 
         * <p>
         * For example, to add a new item, do as follows:
         * <pre>
         *    getVariable().add(newItem);
         * </pre>
         * 
         * 
         * <p>
         * Objects of the following type(s) are allowed in the list
         * {@link InstanceMessageUpdateRequest.Variables.Variable }
         * 
         * 
         */
        public List<InstanceMessageUpdateRequest.Variables.Variable> getVariable() {
            if (variable == null) {
                variable = new ArrayList<InstanceMessageUpdateRequest.Variables.Variable>();
            }
            return this.variable;
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
         *         &lt;element name="operation" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;element name="key" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;element name="type" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;choice>
         *           &lt;element name="valueString" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *           &lt;element name="valueInteger" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
         *           &lt;element name="valueDecimal" type="{http://www.w3.org/2001/XMLSchema}decimal" minOccurs="0"/>
         *           &lt;element name="valueDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
         *           &lt;element name="valueBoolean" type="{http://www.w3.org/2001/XMLSchema}boolean" minOccurs="0"/>
         *         &lt;/choice>
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
            "operation",
            "key",
            "type",
            "valueString",
            "valueInteger",
            "valueDecimal",
            "valueDate",
            "valueBoolean"
        })
        public static class Variable {

            @XmlElement(required = true)
            protected String operation;
            @XmlElement(required = true)
            protected String key;
            @XmlElement(required = true)
            protected String type;
            @XmlElementRef(name = "valueString", type = JAXBElement.class, required = false)
            protected JAXBElement<String> valueString;
            @XmlElementRef(name = "valueInteger", type = JAXBElement.class, required = false)
            protected JAXBElement<BigInteger> valueInteger;
            @XmlElementRef(name = "valueDecimal", type = JAXBElement.class, required = false)
            protected JAXBElement<BigDecimal> valueDecimal;
            @XmlElementRef(name = "valueDate", type = JAXBElement.class, required = false)
            protected JAXBElement<XMLGregorianCalendar> valueDate;
            @XmlElementRef(name = "valueBoolean", type = JAXBElement.class, required = false)
            protected JAXBElement<Boolean> valueBoolean;

            /**
             * Gets the value of the operation property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getOperation() {
                return operation;
            }

            /**
             * Sets the value of the operation property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setOperation(String value) {
                this.operation = value;
            }

            /**
             * Gets the value of the key property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getKey() {
                return key;
            }

            /**
             * Sets the value of the key property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setKey(String value) {
                this.key = value;
            }

            /**
             * Gets the value of the type property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getType() {
                return type;
            }

            /**
             * Sets the value of the type property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setType(String value) {
                this.type = value;
            }

            /**
             * Gets the value of the valueString property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public JAXBElement<String> getValueString() {
                return valueString;
            }

            /**
             * Sets the value of the valueString property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public void setValueString(JAXBElement<String> value) {
                this.valueString = value;
            }

            /**
             * Gets the value of the valueInteger property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link BigInteger }{@code >}
             *     
             */
            public JAXBElement<BigInteger> getValueInteger() {
                return valueInteger;
            }

            /**
             * Sets the value of the valueInteger property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link BigInteger }{@code >}
             *     
             */
            public void setValueInteger(JAXBElement<BigInteger> value) {
                this.valueInteger = value;
            }

            /**
             * Gets the value of the valueDecimal property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}
             *     
             */
            public JAXBElement<BigDecimal> getValueDecimal() {
                return valueDecimal;
            }

            /**
             * Sets the value of the valueDecimal property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}
             *     
             */
            public void setValueDecimal(JAXBElement<BigDecimal> value) {
                this.valueDecimal = value;
            }

            /**
             * Gets the value of the valueDate property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
             *     
             */
            public JAXBElement<XMLGregorianCalendar> getValueDate() {
                return valueDate;
            }

            /**
             * Sets the value of the valueDate property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
             *     
             */
            public void setValueDate(JAXBElement<XMLGregorianCalendar> value) {
                this.valueDate = value;
            }

            /**
             * Gets the value of the valueBoolean property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link Boolean }{@code >}
             *     
             */
            public JAXBElement<Boolean> getValueBoolean() {
                return valueBoolean;
            }

            /**
             * Sets the value of the valueBoolean property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link Boolean }{@code >}
             *     
             */
            public void setValueBoolean(JAXBElement<Boolean> value) {
                this.valueBoolean = value;
            }

        }

    }

}
